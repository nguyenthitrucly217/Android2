<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Str; 

class CategoryController extends Controller
{

    public function category_list($parent_id = 0)
    {
        $args = [
            ['parent_id', '=', $parent_id],
            ['status', '=', 1]
        ];
        $categorys = Category::where($args)
            ->orderBy('sort_order', 'ASC')
            ->get();
        return response()->json(
            [
                'success' => true,
                'message' => 'Tải dữ liệu thành công',
                'categorys' => $categorys
            ],
            200
        );
    }

    //Get ---brand/index --lấy danh sách 
    public function index()

    {

        $categories = Category::orderBy('created_at','DESC')
        ->where('status', 1)
        ->get();

        return response()->json(

            ['success' => true, 'message' => 'Tải dữ liệu thành công', 'categories' => $categories],

            200

        );
    }
    // Get -brand/show-- lấy ra 1 danh mục dựa vào id
    public function show($id)

    {
        if (is_numeric($id))
        {
            $category = Category:: findOrFail($id);
        }
        else
        {
            $category = Category::where ('slug',$id)->first();
        }
        // $category = Category::find($id);
        
        //     if ($category == null){
        //         return response()->json(
        //             ['message'=>'Tải dữ liệu không thành công','success'=>false,'category'=>null],404
        //         );
        //     }
            return response()->json(

                ['success' => true, 'message' => 'Tải dữ liệu thành công', 'category' => $category],
    
                200

        );
    }
    //Post- them store --them danh mục
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name; //form
        $category->description = $request->description; //form

        $category->slug = Str::of($request->name)->slug('-');
        //$brand->image=$request->name;//xử lý riêng
        //up load file
        $files = $request->image;
        if ($files != null) {
            $extension = $files->getClientOriginalExtension();
            if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                $filename = $category->slug . '.' . $extension;
                $category->image = $filename;
                $files->move(public_path('images/category'), $filename);
            }
        }
        $category->parent_id=$request->parent_id;
        $category->sort_order = $request->sort_order; //form
        $category->metakey = $request->metakey; //form
        $category->metadesc = $request->metadesc; //form
        
        $category->created_at = date('Y-m-d H:i:s');
        $category->created_by = 1;
        $category->status = $request->status; //form
        $category->save(); //lưu vào Csdl
        return response()->json(
            ['success' => true, 'message' => 'Thành công', 'data' => $category],
            201
        );
    }
    //category-update --cập nhật dnah mục
    public function update(Request $request, $id)

    {
        $category = Category::find($id);

        $category->name = $request->name; //form
        $category->description = $request->description; //form

        $category->slug = Str::of($request->name)->slug('-');

        $files = $request->image;
        if ($files != null) {
            $extension = $files->getClientOriginalExtension();
            if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                $filename = $category->slug . '.' . $extension;
                $category->image = $filename;
                $files->move(public_path('images/category'), $filename);
            }
        }

        $category->sort_order = $request->sort_order; //form

        $category->metakey = $request->metakey; //form

        $category->metadesc = $request->metadesc; //form

        $category->parent_id=$request->parent_id;


        $category->updated_at = date('Y-m-d H:i:s');

        $category->updated_by = 1; //takm cho =1

        $category->status = $request->status; //form

        $category->save(); //Luuu vao CSDL

        return response()->json(

            ['success' => true, 'message' => 'Thành công', 'category' => $category],

            200

        );
    }
    // xóa danh mục
    public function destroy($id){
        $category = Category::where([['id','=',$id],['status','=',0]])->first();
        if ($category == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
    
        $category ->delete();
        return response()->json(['message'=> 'Xóa khỏi CSDL thành công','success'=>true,'id'=>$id],200);
    }
//xóa tạm
    public function delete($id){
        $category = Category::find($id);
        if($category == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
        $count_categoryid = Product::where('category_id','=',$id)->count();
        if($count_categoryid > 0){
            return response()->json(['success' => false, 'message' =>'Thương hiệu có sản phẩm không thể xóa !']);
        }
        $category->status = 0;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa sản phẩm vào thùng rác !']);
    }



//khôi phuc
    public function restore($id){
        $category = Category::find($id);
        if($category == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
        $category->status = 1;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa phục hồi sản phẩm !']);
    }




    public function get_byPageCa($limit, $page = 1)  // phân trang
    { 
         $countAll = Category::where('status','!=',0)->count();
            $end_page = 1;
            if ($countAll > $limit) {
                $end_page = ceil($countAll / $limit);
            }    
            $offset = ($page - 1) * $limit;
 
            $category = Category::orderBy("created_at", "DESC")
            ->offset($offset)
            ->limit($limit)
            ->where('status', 1)
            ->get();
           
        return response()->json(
 
            ['success' => true, 'message' => "tai du lieu thanh cong", 'categories' => $category,
            'end'=>$end_page
        ],
 
            200
 
        );
    }








public function getlistRestoreCa($limit, $page = 1)  // phân trang
    { 
         $countAll = Category::where('status','!=',1)->count();
            $end_page = 1;
            if ($countAll > $limit) {
                $end_page = ceil($countAll / $limit);
            }    
            $offset = ($page - 1) * $limit;
 
            $category = Category::orderBy("created_at", "DESC")
            ->offset($offset)
            ->limit($limit)
            ->where('status', 0)
            ->get();
           
        return response()->json(
 
            ['success' => true, 'message' => "tai du lieu thanh cong", 'categories' => $category,
            'end'=>$end_page
        ],
 
            200
 
        );
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;

use Illuminate\Support\Str; 

class BrandController extends Controller
{
        //Get ---brand/index
        public function index()

        {
    
            $brands = Brand::orderBy('created_at','DESC')
            ->where('status', 1)
        ->get();


            return response()->json(
    
                ['success' => true, 'message' => 'Tải dữ liệu thành công', 'brands' => $brands],
    
                200
    
            );
        }
        // Get -brand/show
        public function show($id)
    
        {
            if (is_numeric($id))
            {
                $brand = Brand:: findOrFail($id);
            }
            else
            {
                $brand = Brand::where ('slug',$id)->first();
            }
    
            // $brand = Brand::find($id);
            // if ($brand == null){
            //     return response()->json(
            //         ['message'=>'Tải dữ liệu không thành công','success'=>false,'brand'=>null],404
            //     );
            // }
    
            return response()->json(
    
                ['success' => true, 'message' => 'Tải dữ liệu thành công', 'brand' => $brand],
    
                200
    
            );
        }
        //Post- them store
        public function store(Request $request)
        {
            $brand = new Brand();
            $brand->name = $request->name; //form
            $brand->description = $request->description; //form

            $brand->slug = Str::of($request->name)->slug('-');
            //$brand->image=$request->name;//xử lý riêng
    
                    //upload image
                    $files = $request->image;
                    if ($files != null) {
                        $extension = $files->getClientOriginalExtension();
                        if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                            $filename = $brand->slug . '.' . $extension;
                            $brand->image = $filename;
                            $files->move(public_path('images/brand'), $filename);
                        }
                    }
            
            
            $brand->sort_order = $request->sort_order; //form
            $brand->metakey = $request->metakey; //form
            $brand->metadesc = $request->metadesc; //form
            $brand->created_at = date('Y-m-d H:i:s');
            $brand->created_by = 1;
            $brand->status = $request->status; //form
            $brand->save(); //lưu vào Csdl
            return response()->json(
                ['success' => true, 'message' => 'Thành công', 'data' => $brand],
                201
            );
        }
        //cap nhạt
        public function update(Request $request, $id)
    
        {
    
            $brand = Brand::find($id);
    
            $brand->name = $request->name; //form
            $brand->description = $request->description; //form

            $brand->slug = Str::of($request->name)->slug('-');
    
            // $brand->image = $request->name;
                            //upload image
                            $files = $request->image;
                            if ($files != null) {
                                $extension = $files->getClientOriginalExtension();
                                if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                                    $filename = $brand->slug . '.' . $extension;
                                    $brand->image = $filename;
                                    $files->move(public_path('images/brand'), $filename);
                                }
                            }
            
    
            $brand->sort_order = $request->sort_order; //form
    
            $brand->metakey = $request->metakey; //form
    
            $brand->metadesc = $request->metadesc; //form
    
            $brand->updated_at = date('Y-m-d H:i:s');
    
            $brand->updated_by = 1; //takm cho =1
    
            $brand->status = $request->status; //form
    
            $brand->save(); //Luuu vao CSDL
    
            return response()->json(
    
                ['success' => true, 'message' => 'Thành công', 'data' => $brand],
    
                200
    
            );
        }
        //xoa
    //     public function destroya($id)
    //     {
    //         $brand = Brand::find($id);
    //         if($brand == null){
    //             return response()->json(
    //                 ['message'=>'Tai du lieu khong thanh cong','success'=>false,'brand'=> null],404
    //             );
    //         }
    //         $brand->delete();
    //         return response()->json(['message'=> 'thành công','success'=>true,'id'=>$id],200);
    
    //     }

    //xóa tạm
        // public function delete($id){
        //     $brand =Brand::find($id);
        //     if ($brand ==null){
        //         return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        //     }
        //     $count_product =Product::where('brand_id', $id)->count();
        //     if ($count_product>0){
        //         return response()->json( ['message'=>'Thương hiệu có sản phẩm không thể xóa','success'=>false,'brand'=> null],404);

        //     }
        //     $brand->status = 0;
        //     $brand->udate_at=date('Y-m-d H:i:s');
        //     // $brand->updated_by = Auth::id()?? 1;
        //     $brand->save();
        //     return response()->json(['message'=> 'Đã đưa sản phẩm vào thùng rác','success'=>true,'id'=>$id],200);
        // }

//khoi phuc
    // public function restore($id){
    //     $brand =Brand::find($id);
    //     if ($brand == null){
    //     return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);

    //     }
    //     $brand->status = 2;
    //     $brand->updated_at=date('Y-m-d H:i:s');
    //     $brand->save();
    //     return response()->json(['success' => true, 'message' =>'Đã đưa phục hồi sản phẩm !']);
    // }
    //     //xóa luôn
        public function destroy($id){
            $brand = Brand::where([['id','=',$id],['status','=',0]])->first();
            if ($brand == null){
                return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
            }
        
            $brand ->delete();
            return response()->json(['message'=> 'Xóa khỏi CSDL thành công','success'=>true,'id'=>$id],200);
        }
    



        // xoa khoi csdl

        // public function destroy($id)
        // {
        //     $brand = Brand::find($id);
        //     if ($brand == null) {
        //         return response()->json(
        //             ['message' => 'Tai du lieu khong thanh cong', 'success' => false, 'data' => null],
        //             404
        //         );
        //     }
        //     $brand->delete();
        //     return response()->json(['message' => 'thành công', 'success' => true, 'data' => $brand], 200);
        // }
    
        //xoa tam
        // public function delete($id)
        // {
        //     $brand =Brand::table('nttl_brand')
        //           ->where('id', '=',$id)
        //           ->update(['status' => 0]);
        //     return response()->json(['message' => 'thành công', 'success' => true, 'delete' => $brand], 200);
        // }
        public function delete($id){
            $brand = Brand::find($id);
            if($brand == null){
                return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
            }
            $count_brandid = Product::where('brand_id','=',$id)->count();
            if($count_brandid > 0){
                return response()->json(['success' => false, 'message' =>'Thương hiệu có sản phẩm không thể xóa !']);
            }
            $brand->status = 0;
            $brand->updated_at = date('Y-m-d H:i:s');
            $brand->save();
            return response()->json(['success' => true, 'message' =>'Đã đưa sản phẩm vào thùng rác !']);
        }

        // khoi phuc
        // public function restore($id)
        // {
        //     $brand = DB::table('nttl_brand')
        //           ->where('id', '=',$id)
        //           ->update(['status' => 1]);
        //     return response()->json(['message' => 'thành công', 'success' => true, 'restore' => $brand], 200);
        // }
        public function restore($id){
            $brand = Brand::find($id);
            if($brand == null){
                return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
            }
            $brand->status = 1;
            $brand->updated_at = date('Y-m-d H:i:s');
            $brand->save();
            return response()->json(['success' => true, 'message' =>'Đã đưa phục hồi sản phẩm !']);
        }




    public function get_byPageBr($limit, $page = 1)  // phân trang
    { 
         $countAll = Brand::where('status','!=',0)->count();
            $end_page = 1;
            if ($countAll > $limit) {
                $end_page = ceil($countAll / $limit);
            }    
            $offset = ($page - 1) * $limit;
 
            $brand = Brand::orderBy("created_at", "DESC")
            ->offset($offset)
            ->limit($limit)
            ->where('status', 1)
            ->get();
           
        return response()->json(
 
            ['success' => true, 'message' => "tai du lieu thanh cong", 'brands' => $brand,
            'end'=>$end_page
        ],
 
            200
 
        );
    }
 
    public function getlistRestore($limit, $page = 1)  // phân trang
    { 
         $countAll = Brand::where('status','!=',1)->count();
            $end_page = 1;
            if ($countAll > $limit) {
                $end_page = ceil($countAll / $limit);
            }    
            $offset = ($page - 1) * $limit;
 
            $brand = Brand::orderBy("created_at", "DESC")
            ->offset($offset)
            ->limit($limit)
            ->where('status', 0)
            ->get();
           
        return response()->json(
 
            ['success' => true, 'message' => "tai du lieu thanh cong", 'brands' => $brand,
            'end'=>$end_page
        ],
 
            200
 
        );
    }


    
}

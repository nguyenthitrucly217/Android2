<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use App\Http\Controllers\Api\SliderController;

class SliderController extends Controller
{
    public function slider_list($position)
    {
        $args = [
            ['position', '=', $position],
            ['status', '=', 1]
        ];
        $sliders = Slider::where($args)
            ->orderBy('sort_order', 'ASC')
            ->get();
        return response()->json(
            [
                'success' => true,
                'message' => 'Tải dữ liệu thành công',
                'sliders' => $sliders
            ],
            200
        );
    }

    
    //Get ---slider/index
            public function index()

            {
        
                $sliders = Slider::orderBy('id','ASC')->get();
        
                return response()->json(
        
                    ['success' => true, 'message' => 'Tải dữ liệu thành công', 'sliders' => $sliders],
        
                    200
        
                );
            }
            // Get -slider/show
            public function show($id)
        
            {
        
                $slider = Slider::find($id);
                if ($slider == null){
                    return response()->json(
                        ['message'=>'Tải dữ liệu không thành công','success'=>false,'slider'=>null],404
                    );
                }
    
                return response()->json(
        
                    ['success' => true, 'message' => 'Tải dữ liệu thành công', 'slider' => $slider],
        
                    200
        
                );
            }
            //Post- them store
            public function store(Request $request)
            {
                $slider = new Slider();
                $slider->name = $request->name; //form
                $slider->link = $request->link;
                $slider->sort_order = $request->sort_order; //form
                $slider->position = $request->position; //form
                $slider->description = $request->description; //form

                                            //upload image
                    $files = $request->image;
                    if ($files != null) {
                        $extension = $files->getClientOriginalExtension();
                        if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                            $filename = $slider->name . '.' . $extension;
                            $slider->image = $filename;
                            $files->move(public_path('images/slider'), $filename);
                        }
                    }

                $slider->created_at = date('Y-m-d H:i:s');
                $slider->created_by = 1;
                $slider->status = $request->status; //form
                $slider->save(); //lưu vào Csdl
                return response()->json(
                    ['success' => true, 'message' => 'Thành công', 'slider' => $slider],
                    201
                );
            }
            //slider-update
            public function update(Request $request, $id)
            {
                $slider = Slider::find($id);
                $slider->name = $request->name; //form
                $slider->link = $request->link;
                $slider->sort_order = $request->sort_order; //form
                $slider->position = $request->position; //form
                $slider->description = $request->description; //form

                    //upload image
                    $files = $request->image;
                    if ($files != null) {
                        $extension = $files->getClientOriginalExtension();
                        if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                            $filename = $slider->name . '.' . $extension;
                            $slider->image = $filename;
                            $files->move(public_path('images/slider'), $filename);
                        }
                    }
                $slider->updated_at = date('Y-m-d H:i:s');
                $slider->updated_by = 1; //takm cho =1
                $slider->status = $request->status; //form
                $slider->save(); //Luuu vao CSDL
                return response()->json(
        
                    ['success' => true, 'message' => 'Thành công', 'slider' => $slider],
        
                    200
        
                );
            }
    // xóa khỏi CSDL
    public function destroy($id){
        $slider = Slider::where([['id','=',$id],['status','=',0]])->first();
        if ($slider == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
    
        $slider ->delete();
        return response()->json(['message'=> 'Xóa khỏi CSDL thành công','success'=>true,'id'=>$id],200);
    }
//xóa tạm
    public function delete($id){
        $slider = Slider::find($id);
        if($slider == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }

        $slider->status = 0;
        $slider->updated_at = date('Y-m-d H:i:s');
        $slider->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa sản phẩm vào thùng rác !']);
    }
//khôi phuc
    public function restore($id){
        $slider = Slider::find($id);
        if($slider == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
        $slider->status = 1;
        $slider->updated_at = date('Y-m-d H:i:s');
        $slider->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa phục hồi sản phẩm !']);
    }

            public function get_byPageSli($limit, $page = 1)  // phân trang
            { 
                 $countAll = Slider::where('status','!=',0)->count();
                    $end_page = 1;
                    if ($countAll > $limit) {
                        $end_page = ceil($countAll / $limit);
                    }    
                    $offset = ($page - 1) * $limit;
         
                    $slider = Slider::orderBy("created_at", "DESC")
                    ->offset($offset)
                    ->limit($limit)
                    ->where('status', 1)
                    ->get();
                   
                return response()->json(
         
                    ['success' => true, 'message' => "tai du lieu thanh cong", 'sliders' => $slider,
                    'end'=>$end_page
                ],
         
                    200
         
                );
            }
       
            
            public function getlistRestore($limit, $page = 1)  // phân trang
            { 
                 $countAll = Slider::where('status','!=',1)->count();
                    $end_page = 1;
                    if ($countAll > $limit) {
                        $end_page = ceil($countAll / $limit);
                    }    
                    $offset = ($page - 1) * $limit;
         
                    $slider = Slider::orderBy("created_at", "DESC")
                    ->offset($offset)
                    ->limit($limit)
                    ->where('status',0)
                    ->get();
                   
                return response()->json(
         
                    ['success' => true, 'message' => "tai du lieu thanh cong", 'sliders' => $slider,
                    'end'=>$end_page
                ],
         
                    200
         
                );
            }
         

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use App\Http\Controllers\Api\OrderdetailController;
use Illuminate\Support\Facades\DB; 

class OrderdetailController extends Controller
{
            //Get ---orderdetail/index
            public function index()

            {
        
                $orderdetails = DB::table("nttl_orderdetail")->join("nttl_product","nttl_orderdetail.product_id","=","nttl_product.id")->select("nttl_orderdetail.*","nttl_product.name as product_name","nttl_product.image as product_image")->get();
        
                return response()->json(
        
                    ['success' => true, 'message' => 'Tải dữ liệu thành công', 'orderdetails' => $orderdetails],
        
                    200
        
                );
            }
            // Get -orderdetail/show
            public function show($id)
        
            {
        
                $orderdetail = Orderdetail::find($id);
                if ($orderdetail == null){
                    return response()->json(
                        ['message'=>'Tải dữ liệu không thành công','success'=>false,'orderdetail'=>null],404
                    );
                }
    
                return response()->json(
        
                    ['success' => true, 'message' => 'Tải dữ liệu thành công', 'orderdetail' => $orderdetail],
        
                    200
        
                );
            }
            //Post- them store
            public function store(Request $request)
            {
                $orderdetail = new Orderdetail();
                $orderdetail->order_id = $request->order_id; //form
                //$orderdetail->image=$request->name;//xử lý riêng
                $orderdetail->product_id = $request->product_id; //form
                $orderdetail->price = $request->price;
                $orderdetail->discount = $request->discount;

                $orderdetail->quality = $request->quality; //form
                $orderdetail->amount = $request->amount; //form
                $orderdetail->created_at = date('Y-m-d H:i:s');
                $orderdetail->created_by = 1;
    
                 //form
                $orderdetail->save(); //lưu vào Csdl
                return response()->json(
                    ['success' => true, 'message' => 'Thành công', 'orderdetail' => $orderdetail],
                    201
                );
            }
            //orderdetail-update
            public function update(Request $request, $id)
        
            {
        
                $orderdetail = Orderdetail::find($id);
        
                $orderdetail->order_id = $request->order_id; //form
                //$orderdetail->image=$request->name;//xử lý riêng
                $orderdetail->product_id = $request->product_id; //form
                $orderdetail->price = $request->price;
                $orderdetail->discount = $request->discount;

                $orderdetail->quality = $request->quality; //form
                $orderdetail->amount = $request->amount; //form
                $orderdetail->updated_at = date('Y-m-d H:i:s');
    
                $orderdetail->updated_by = 1; //takm cho =1
    
                $orderdetail->save(); //Luuu vao CSDL
        
                return response()->json(
        
                    ['success' => true, 'message' => 'Thành công', 'orderdetail' => $orderdetail],
        
                    200
        
                );
            }
            //xoa
            public function destroy ($id)
            {
                $orderdetail = Orderdetail::find($id);
                if($orderdetail == null){
                    return response()->json(
                        ['message'=>'Tai du lieu khong thanh cong','success'=>false,'orderdetail'=> null],404
                    );
                }
                $orderdetail->delete();
                return response()->json(['message'=> 'thành công','success'=>true,'id'=>$id],200);
        
            }


            
            public function get_byPageOrde($limit, $page = 1)  // phân trang
        { 
             $countAll = Orderdetail::where('order_id','!=',0)->count();
                $end_page = 1;
                if ($countAll > $limit) {
                    $end_page = ceil($countAll / $limit);
                }    
                $offset = ($page - 1) * $limit;
     
                $orderdetail = Orderdetail::orderBy("created_at", "DESC")
                ->offset($offset)
                ->limit($limit)
                ->get();
               
            return response()->json(
     
                ['success' => true, 'message' => "tai du lieu thanh cong", 'orderdetails' => $orderdetail,
                'end'=>$end_page
            ],
     
                200
     
            );
        }

}

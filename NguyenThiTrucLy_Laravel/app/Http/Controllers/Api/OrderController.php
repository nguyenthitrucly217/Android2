<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orderdetail;

use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB; 

use App\Http\Controllers\Api\OrderController;

class OrderController extends Controller
{
        //Get ---order/index
        public function index($id)

        {
    
            $orders = DB::table("nttl_order")->where([["user_id","=",$id]])->orderBy('id','ASC')->get();
    
            return response()->json(
    
                ['success' => true, 'message' => 'Tải dữ liệu thành công', 'orders' => $orders],
    
                200
    
            );
        }
        public function checkout(Request $request)
        {
    
            $orders = DB::table("nttl_order");
            $id_order=$orders->insertGetId([
                "user_id"=>$request->id_user,
                "name"=>$request->name,
                "phone"=>$request->phone,
                "address"=>$request->address,
                "email"=>$request->email,
                "note"=>$request->note,

            ]);
            foreach($request->order_detail as $item){
                $insert_order=DB::table("nttl_orderdetail")->insert([
                    "order_id"=>$id_order,
                    "product_id"=>$item["_id"],
                    "price"=>$item["price"],
                    "quality"=>$item["quantity"],
                    "amount"=>$item["price"]*$item["quantity"],
                ]);
            }
    
            return response()->json(
    
                ['success' => true, 'message' => 'Đặt hàng thành công!'],
    
                200
    
            );
        }
        // Get -order/show
        public function show($id)
    
        {
    
            $order = Order::find($id);
            if ($order == null){
                return response()->json(
                    ['message'=>'Tải dữ liệu không thành công','success'=>false,'order'=>null],404
                );
            }

            return response()->json(
    
                ['success' => true, 'message' => 'Tải dữ liệu thành công', 'order' => $order],
    
                200
    
            );
        }
        //Post- them store
        public function store(Request $request)
        {
            $order = new Order();
            $order->user_id=$request->user_id;
            $order->name = $request->name; //form
            // $order->gender = $request->gender; //form

            $order->phone =$request->phone;
            //$order->image=$request->name;//xử lý riêng

            $order->email = $request->email; //form
            $order->address = $request->address; //form
            $order->note = $request->note; //form
            
            $order->created_at = date('Y-m-d H:i:s');
            $order->created_by = 1;
            $order->status = $request->status; //form
            $order->save(); //lưu vào Csdl
            return response()->json(
                ['success' => true, 'message' => 'Thành công', 'order' => $order],
                201
            );
        }
        //order-update
        public function update(Request $request, $id)
    
        {
    
            $order = Order::find($id);
    
            $order->user_id=$request->user_id;
            $order->name = $request->name; //form
            $order->phone =$request->phone;
            //$order->image=$request->name;//xử lý riêng

            $order->email = $request->email; //form
            $order->address = $request->address; //form
            $order->note = $request->note; //form
            
    
            $order->updated_at = date('Y-m-d H:i:s');
    
            $order->updated_by = 1; //takm cho =1
    
            $order->status = $request->status; //form
    
            $order->save(); //Luuu vao CSDL
    
            return response()->json(
    
                ['success' => true, 'message' => 'Thành công', 'order' => $order],
    
                200
    
            );
        }
        //xoa
    // xóa khỏi CSDL
    public function destroy($id){
        $order = Order::where([['id','=',$id],['status','=',0]])->first();
        if ($order == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
    
        $order ->delete();
        return response()->json(['message'=> 'Xóa khỏi CSDL thành công','success'=>true,'id'=>$id],200);
    }
//xóa tạm
    public function delete($id){
        $order = Order::find($id);
        if($order == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
        $count_orderid = Orderdetail::where('order_id','=',$id)->count();
        if($count_orderid > 0){
            return response()->json(['success' => false, 'message' =>'Đơn hàng đang kiểm duyệt không thể xóa !']);
        }
        $order->status = 0;
        $order->updated_at = date('Y-m-d H:i:s');
        $order->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa sản phẩm vào thùng rác !']);
    }
//khôi phuc
    public function restore($id){
        $order = Order::find($id);
        if($order == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
        $order->status = 1;
        $order->updated_at = date('Y-m-d H:i:s');
        $order->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa phục hồi sản phẩm !']);
    }
    


        public function infomationadd(Request $request)
        {
            $order = new Order();
            $order->user_id=$request->user_id;
            $order->name = $request->name; //form
            $order->gender = $request->gender; //form

            $order->phone =$request->phone;
            //$order->image=$request->name;//xử lý riêng

            $order->email = $request->email; //form
            $order->address = $request->address; //form
            $order->note = $request->note; //form
            
            $order->created_at = date('Y-m-d H:i:s');
            $order->created_by = 1;
            $order->status = $request->status; //form
            $order->save(); //lưu vào Csdl
            return response()->json(
                ['success' => true, 'message' => 'Thành công', 'order' => $order],
                200
            );
        }

        public function get_byPageOr($limit, $page = 1)  // phân trang
        { 
             $countAll = Order::where('status','!=',0)->count();
                $end_page = 1;
                if ($countAll > $limit) {
                    $end_page = ceil($countAll / $limit);
                }    
                $offset = ($page - 1) * $limit;
     
                $order = Order::orderBy("created_at", "DESC")
                ->offset($offset)
                ->limit($limit)
                ->where('status', 1)
                ->get();
               
            return response()->json(
     
                ['success' => true, 'message' => "tai du lieu thanh cong", 'orders' => $order,
                'end'=>$end_page
            ],
     
                200
     
            );
        }


        public function getlistRestore($limit, $page = 1)  // phân trang
        { 
             $countAll = Order::where('status','!=',1)->count();
                $end_page = 1;
                if ($countAll > $limit) {
                    $end_page = ceil($countAll / $limit);
                }    
                $offset = ($page - 1) * $limit;
     
                $order = Order::orderBy("created_at", "DESC")
                ->offset($offset)
                ->limit($limit)
                ->where('status', 0)
                ->get();
               
            return response()->json(
     
                ['success' => true, 'message' => "tai du lieu thanh cong", 'orders' => $order,
                'end'=>$end_page
            ],
     
                200
     
            );
        }

}

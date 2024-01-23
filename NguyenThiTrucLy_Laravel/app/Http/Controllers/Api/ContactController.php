<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use App\Http\Controllers\Api\ContactController;

class ContactController extends Controller
{
        //Get ---contact/index
        public function index()
        {
            $contacts = Contact::all(); //::where()->orderBy()->get();   
            return response()->json(
                ['success' => true, 'message' => 'Tải dữ liệu thành công', 'contacts' => $contacts],
                200
            );
        }
        // Get -contact/show
        public function show($id)
        {
            $contact = Contact::find($id);
            if($contact==null){
                return response()->json(
                    ['success' => false, 'message' => 'Tải dữ liệu không thành công', 'contact' => null],
                    404
                );
            }
            return response()->json(
                ['success' => true, 'message' => 'Tải dữ liệu thành công', 'contact' => $contact],
                200
            );
        }
        //Post- them store
        public function store(Request $request)
        {
            $contact = new Contact();
            //$contact->user_id = 1;
            $contact->name = $request->name; //form
            $contact->email = $request->email; //form
            $contact->phone = $request->phone; //form
            $contact->title = $request->title; //form
            $contact->content = $request->content; //form
            //$contact->slug = Str::of($request->name)->slug('-');
            //$contact->image=$request->name;//xử lý riêng
            //$contact->sort_order = $request->sort_order; //form
            //$contact->metakey = $request->metakey; //form
            //$contact->metadesc = $request->metadesc; //form
            //$contact->parent_id=$request->parent_id;
            $contact->created_at = date('Y-m-d H:i:s');
            $contact->created_by = 1;
            $contact->replay_id =$request->replay_id;
            $contact->status = $request->status; //form
            $contact->save(); //lưu vào Csdl
            return response()->json(
                ['success' => true, 'message' => 'Thành công', 'contact' => $contact],
                201
            );
        }
        //contact-update
        public function update(Request $request, $id)
        {
            $contact = Contact::find($id);
            //$contact->user_id = 1;
            $contact->name = $request->name; //form
            $contact->email = $request->email; //form
            $contact->phone = $request->phone; //form
            $contact->title = $request->title; //form
            $contact->content = $request->content; //form
            //$contact->slug = Str::of($request->name)->slug('-');
            // $contact->image = $request->name;
            //$contact->sort_order = $request->sort_order; //form
            //$contact->metakey = $request->metakey; //form
            //$contact->metadesc = $request->metadesc; //form
            //$contact->parent_id=$request->parent_id;
            $contact->updated_at = date('Y-m-d H:i:s');
            $contact->replay_id = $request->replay_id;
            $contact->updated_by = 1; //takm cho =1
            $contact->status = $request->status; //form
            $contact->save(); //Luuu vao CSDL
            return response()->json(
                ['success' => true, 'message' => 'Thành công', 'contact' => $contact],
                200
            );
        }


    // xóa khỏi CSDL
    public function destroy($id){
        $contact = Contact::where([['id','=',$id],['status','=',0]])->first();
        if ($contact == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
    
        $contact ->delete();
        return response()->json(['message'=> 'Xóa khỏi CSDL thành công','success'=>true,'id'=>$id],200);
    }
//xóa tạm
    public function delete($id){
        $contact = Contact::find($id);
        if($contact == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
        // $count_categoryid = Product::where('category_id','=',$id)->count();
        // if($count_categoryid > 0){
        //     return response()->json(['success' => false, 'message' =>'Thương hiệu có sản phẩm không thể xóa !']);
        // }
        $contact->status = 0;
        $contact->updated_at = date('Y-m-d H:i:s');
        $contact->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa sản phẩm vào thùng rác !']);
    }



//khôi phuc
    public function restore($id){
        $contact = Contact::find($id);
        if($contact == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
        $contact->status = 1;
        $contact->updated_at = date('Y-m-d H:i:s');
        $contact->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa phục hồi sản phẩm !']);
    }

        public function contacthome(Request $request)
        {
            $contact = new Contact();
            $contact->name = $request->name; //form
            $contact->email = $request->email; //form
            $contact->phone = $request->phone; //form
            $contact->title = $request->title; //form
            $contact->content = $request->content; //form
            $contact->created_at = date('Y-m-d H:i:s');
            $contact->created_by = 1;
            $contact->replay_id = $request->replay_id;
            $contact->status = $request->status; //form
            $contact->save(); //lưu vào Csdl
            return response()->json(
                ['success' => true, 'message' => 'Thành công', 'contact' => $contact],
                201
            );
        }


        public function get_byPageCo($limit, $page = 1)  // phân trang
        { 
             $countAll = Contact::where('status','!=',0)->count();
                $end_page = 1;
                if ($countAll > $limit) {
                    $end_page = ceil($countAll / $limit);
                }    
                $offset = ($page - 1) * $limit;
     
                $contact = Contact::orderBy("created_at", "DESC")
                ->offset($offset)
                ->limit($limit)
                ->where('status', 1)
                ->get();
               
            return response()->json(
     
                ['success' => true, 'message' => "tai du lieu thanh cong", 'contacts' => $contact,
                'end'=>$end_page
            ],
     
                200
     
            );
        }
    

        public function getlistRestore($limit, $page = 1)  // phân trang
        { 
             $countAll = Contact::where('status','!=',1)->count();
                $end_page = 1;
                if ($countAll > $limit) {
                    $end_page = ceil($countAll / $limit);
                }    
                $offset = ($page - 1) * $limit;
     
                $contact = Contact::orderBy("created_at", "DESC")
                ->offset($offset)
                ->limit($limit)
                ->where('status', 0)
                ->get();
               
            return response()->json(
     
                ['success' => true, 'message' => "tai du lieu thanh cong", 'contacts' => $contact,
                'end'=>$end_page
            ],
     
                200
     
            );
        }

 }

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Contact;
use App\Models\Menu;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use App\Http\Controllers\Api\UserController;

class UserController extends Controller
{
           //Get ---use/index
           public function index()

           {
                $users = User::all(); 
       
               return response()->json(
       
                   ['success' => true, 'message' => 'Tải dữ liệu thành công', 'users' => $users],
       
                   200
       
               );
           }
           public function indexcustomer()

           {
       
               $users = User::orderBy('created_at','DESC')->get();
                      $users = User::where("roles","=","customer")->get();

               return response()->json(
       
                   ['success' => true, 'message' => 'Tải dữ liệu thành công', 'users' => $users],
       
                   200
       
               );
           }

           // Get -use/show
           public function show($id)
       
           {
       
               $user = User::find($id);
               if ($user == null){
                return response()->json(
                    ['message'=>'Tải dữ liệu không thành công','success'=>false,'user'=>null],404
                );
            }

               return response()->json(
       
                   ['success' => true, 'message' => 'Tải dữ liệu thành công', 'user' => $user],
       
                   200
       
               );
           }
           //Post- them store
           public function store(Request $request)
           {
               $user = new User();
               $user->name = $request->name; //form
               $user->email = $request->email; //form
               $user->phone = $request->phone; //form
               $user->username = $request->username; //form
               $user->password=$request->password;
               $user->address=$request->address;   
               //images
               $files = $request->image;
               if ($files != null) {
                   $extension = $files->getClientOriginalExtension();
                   if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                       $filename = $user->username . '.' . $extension;
                       $user->image = $filename;
                       $files->move(public_path('images/user'), $filename);
                   }
               }
       
               $user->roles=$request->roles;           
               $user->created_at = date('Y-m-d H:i:s');
               $user->created_by = 1;
               $user->status = $request->status; //form
               $user->save(); //lưu vào Csdl
               return response()->json(
                   ['success' => true, 'message' => 'Thành công', 'user' => $user],
                   201
               );
           }
           //use-update
           public function update(Request $request, $id)
       
           {
       
               $user = User::find($id);
       
               $user->name = $request->name; //form
               $user->email = $request->email; //form
               $user->phone = $request->phone; //form
               $user->username = $request->username; //form
               $user->password=$request->password;
               $user->address=$request->address;   
               //images
               $files = $request->image;
               if ($files != null) {
                   $extension = $files->getClientOriginalExtension();
                   if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                       $filename = $user->username . '.' . $extension;
                       $user->image = $filename;
                       $files->move(public_path('images/user'), $filename);
                   }
               }
       
               $user->roles=$request->roles;           
               $user->updated_at = date('Y-m-d H:i:s');
       
               $user->updated_by = 1; //takm cho =1
       
               $user->status = $request->status; //form
       
               $user->save(); //Luuu vao CSDL
       
               return response()->json(
       
                   ['success' => true, 'message' => 'Thành công', 'user' => $user],
       
                   200
       
               );
           }

           public function kiemtra(Request $request)
           {
            $args = [
                ['email', '=',$request->email],
                ['password', '=',$request->password],
                ['status','=',1]
            ];
            $user = User::where($args);
            if($user->count()>0){
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Đăng nhập thành công',
                        'user' => $user->get()
                    ],
                    200
                );
            }else{
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Đăng nhập không thành công',
                        'user' => $user->get()
                    ],
                    200
                ); 
            }

    
           }

           public function registerhome(Request $request)
        {
            $user = new User();
            $user->name = $request->name; //form
            $user->email = $request->email; //form
            $user->phone = $request->phone; //form
            // $user->image = $request->image; //form
            $user->password=$request->password;
            // $user->roles = $request->roles; //form
            $user->created_at = date('Y-m-d H:i:s');
            $user->created_by = 1;
            // $user->status = $request->status; //form
            $user->save(); //lưu vào Csdl
         return response()->json(
                ['success' => true, 'message' => 'Đăng ký thành công', 'user' => $user],
                200
            );
        }

        public function get_byPageUs($limit, $page = 1)  // phân trang
        { 
             $countAll = User::where('status','!=',0)->count();
             $users = User::where('roles','==','user')->get();

                $end_page = 1;
                if ($countAll > $limit) {
                    $end_page = ceil($countAll / $limit);
                }    
                $offset = ($page - 1) * $limit;
     
                $user = User::orderBy("created_at", "DESC")
                ->offset($offset)
                ->limit($limit)
                ->where('status', 1)
                ->where('roles', 'user')

                ->get();
               
            return response()->json(
     
                ['success' => true, 'message' => "tai du lieu thanh cong", 'users' => $user,
                'end'=>$end_page
            ],
     
                200
     
            );
        }


        public function getlistRestoreUs($limit, $page = 1)  // phân trang
        { 
             $countAll = User::where('status','!=',1)->count();
             $users = User::where("roles","==","user")->get();

                $end_page = 1;
                if ($countAll > $limit) {
                    $end_page = ceil($countAll / $limit);
                }    
                $offset = ($page - 1) * $limit;
     
                $user = User::orderBy("created_at", "DESC")
                ->offset($offset)
                ->limit($limit)
                ->where('status', 0)
                ->where('roles', 'user')

                ->get();
               
            return response()->json(
     
                ['success' => true, 'message' => "tai du lieu thanh cong", 'users' => $user,
                'end'=>$end_page
            ],
     
                200
     
            );
        }



        public function getlistRestoreCus($limit, $page = 1)  // phân trang
        { 
             $countAll = User::where('status','!=',1)->count();
             $users = User::where("roles","==","customer")->get();

                $end_page = 1;
                if ($countAll > $limit) {
                    $end_page = ceil($countAll / $limit);
                }    
                $offset = ($page - 1) * $limit;
     
                $user = User::orderBy("created_at", "DESC")
                ->offset($offset)
                ->limit($limit)
                ->where('status', 0)
                ->where('roles', 'customer')

                ->get();
               
            return response()->json(
     
                ['success' => true, 'message' => "tai du lieu thanh cong", 'users' => $user,
                'end'=>$end_page
            ],
     
                200
     
            );
        }


            // xóa khoi csdl
    public function destroy($id){
        $user = User::where([['id','=',$id],['status','=',0]])->first();
        if ($user == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
    
        $user ->delete();
        return response()->json(['message'=> 'Xóa khỏi CSDL thành công','success'=>true,'id'=>$id],200);
    }
//xóa tạm
    public function delete($id){
        $user = User::find($id);
        if($user == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
        $count_contact = Contact::where('user_id','=',$id)->count();
        if($count_contact > 0){
            return response()->json(['success' => false, 'message' =>'Có trong liên hệ không thể xoa !']);
        }
        $count_menu= Menu::where('user_id','=',$id)->count();
        if($count_menu > 0){
            return response()->json(['success' => false, 'message' =>'Có trong menu không thể xóa !']);
        }
        $count_order= Order::where('user_id','=',$id)->count();
        if($count_order > 0){
            return response()->json(['success' => false, 'message' =>'Có trong đặt hàng không thể xóa !']);
        }

        $user->status = 0;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa sản phẩm vào thùng rác !']);
    }
//khôi phuc
    public function restore($id){
        $user = User::find($id);
        if($user == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
        $user->status = 1;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa phục hồi sản phẩm !']);
    }


    public function get_byPageCus($limit, $page = 1)  // phân trang
    { 
         $countAll = User::where('status','!=',0)->count();
         $users = User::where("roles","==","customer")->get();

            $end_page = 1;
            if ($countAll > $limit) {
                $end_page = ceil($countAll / $limit);
            }    
            $offset = ($page - 1) * $limit;
 
            $user = User::orderBy("created_at", "DESC")
            ->offset($offset)
            ->limit($limit)
            ->where('status', 1)
            ->where('roles', 'customer')

            ->get();
           
        return response()->json(
 
            ['success' => true, 'message' => "tai du lieu thanh cong", 'users' => $user,
            'end'=>$end_page
        ],
 
            200
 
        );
    }

}
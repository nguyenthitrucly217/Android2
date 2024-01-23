<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use App\Http\Controllers\Api\PostController;

class PostController extends Controller
{


    function post_list( $limit,$type)
    {
        $args = [
            ['type', '=', $type],
            ['status', '=', 1]
        ];
        $posts = Post::where($args)
            ->orderBy('created_at', 'DESC')
            -> limit($limit)
            ->get();
        return response()->json(
            [
                'success' => true,
                'message' => 'Tải dữ liệu thành công',
                'posts' => $posts
            ],
            200
        );
    }


    function post_listPa($type)
    {
        $args = [
            // ['slug','=',$slug],
            ['type', '=', $type],
            ['status', '=', 1]
        ];
        $posts = Post::where($args)
            ->orderBy('created_at', 'DESC')
            ->get();
        return response()->json(
            [
                'success' => true,
                'message' => 'Tải dữ liệu thành công',
                'posts' => $posts
            ],
            200
        );
    }


//     function post_list( $limit,$topic_id=0)
//     {
//         $listid = array();
//         array_push($listid, $topic_id + 0);
//         $args_top1 = [
//             ['parent_id', '=', $topic_id + 0],
//             ['status', '=', 1]
//         ];
//         $list_topic1 = Topic::where($args_top1)->get();
//         if (count($list_topic1) > 0) {
//             foreach ($list_topic1 as $row1) {
//                 array_push($listid, $row1->id);
//                 $args_top2 = [
//                     ['parent_id', '=', $row1->id],
//                     ['status', '=', 1]
//                 ];
//                 $list_topic2 = Topic::where($args_top2)->get();
//                 if (count($list_topic2) > 0) {
//                     foreach ($list_topic2 as $row2) {
//                         array_push($listid, $row2->id);
//                     }
//                 }
//             }
//         }
//         $posts = Post::where('status','=', 1)
//             ->whereIn('topic_id', $listid)
//             ->orderBy('created_at', 'DESC')
//             ->limit($limit)
//             ->get();
            
// if(count($posts)){
//     return response()->json(
//         [
//             'success' => true,
//             'message' => 'Tải dữ liệu thành công',
//             'posts' => $posts
//         ],
//         200
//     );
// }
// else{
//     return response()->json(
//         [
//             'success' => false,
//             'message' => 'Không có dữ liệu',
//             'posts' => null
//         ],
//        404
//     );
// }
// }

//POST_TOPIC

public function post_topic( $limit,$topic_id)
{
    $listid = array();
            array_push($listid, $topic_id + 0);
            $args_top1 = [
                ['parent_id', '=', $topic_id + 0],
                ['status', '=', 1]
            ];
            $list_topic1 = Topic::where($args_top1)->get();
            if (count($list_topic1) > 0) {
                foreach ($list_topic1 as $row1) {
                    array_push($listid, $row1->id);
                    $args_top2 = [
                        ['parent_id', '=', $row1->id],
                        ['status', '=', 1]
                    ];
                    $list_topic2 = Topic::where($args_top2)->get();
                    if (count($list_topic2) > 0) {
                        foreach ($list_topic2 as $row2) {
                            array_push($listid, $row2->id);
                        }
                    }
                }
            }
    $posts = Post::where('status', 1)
        ->whereIn('topic_id', $listid)
        ->orderBy('created_at', 'DESC')
        ->limit($limit)
        ->get();
    return response()->json(
        [
            'success' => true,
            'message' => 'Tải dữ liệu thành công',
            'posts' => $posts
        ],
        200
    );
}


//POST_ALL
    public function post_all($type)
    {

        $args = [
            // ['slug','=',$slug],
            ['type', '=', $type],
            ['status', '=', 1]
        ];
        $post =  Post::where($args)
        ->orderBy('created_at', 'DESC')
        ->get();
        return response()->json(
            [
                'success' => true,
                'message' => 'Tải dữ liệu thành công',
                'post' => $post
            ],
            200
        );

    }


//POST_DETAIL
    public function post_detail($id)
{
    $post =Post::where ([['id','=',$id],['status','=',1]])->first();
    if ($post==null){
        return response()->json(
            [
                'success' => false,
                'message' => 'Khong co du lieu',
                'post' =>null
            ],
            404
        );
    }
    $listid = array();
    array_push($listid, $post->topic_id);
    $args_top1 = [
        ['parent_id', '=',$post->topic_id],
        ['status', '=', 1]
    ];
    $list_topic1 = Topic::where($args_top1)->get();
    if (count($list_topic1) > 0) {
        foreach ($list_topic1 as $row1) {
            array_push($listid, $row1->id);
            $args_top2 = [
                ['parent_id', '=', $row1->id],
                ['status', '=', 1]
            ];
            $list_topic2 = Topic::where($args_top2)->get();
            if (count($list_topic2) > 0) {
                foreach ($list_topic2 as $row2) {
                    array_push($listid, $row2->id);
                }
            }
        }
    }
    $post_order = Post::where([['id','!=',$post->id],['status','=',1]])
        ->whereIn('topic_id', $listid)
        ->orderBy('created_at', 'DESC')
        ->limit(8)
        ->get();
        return response()->json(
            [
                'success' => true,
                'message' => 'Tải dữ liệu thành công',
                'post' => $post,
                'post_order'=>$post_order,
            ],
            200
        );
    }
    
           //Get ---post/index
           public function index()

           {
       
               $posts = Post::orderBy('created_at','DESC')->get();
       
               return response()->json(
       
                   ['success' => true, 'message' => 'Tải dữ liệu thành công', 'posts' => $posts],
       
                   200
       
               );
           }

                      //Get ---post/index
                      public function indexPa()

                      {
                  
                          $posts = Post::where("type","=","page")->get();
                  
                          return response()->json(
                  
                              ['success' => true, 'message' => 'Tải dữ liệu thành công', 'posts' => $posts],
                  
                              200
                  
                          );
                      }
           
           // Get -post/show
           public function show($id)
       
           {
       
            if (is_numeric($id))
            {
                $post = Post:: findOrFail($id);
            }
            else
            {
                $post = Post::where ('slug',$id)->first();
            }
               return response()->json(
       
                   ['success' => true, 'message' => 'Tải dữ liệu thành công', 'post' => $post],
       
                   200
       
               );
           }


           //Post- them store
           public function store(Request $request)
           {
               $post = new Post();
            //    $post->discription = $request->discription; //form
               $post->topic_id = $request->topic_id; //form
               $post->title = $request->title; //form
               $post->slug = Str::of($request->title)->slug('-');
               $post->detail = $request->detail; //form
               //$post->image=$request->name;//xử lý riêng
               $files = $request->image;
               if ($files != null) {
                   $extension = $files->getClientOriginalExtension();
                   if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                       $filename = $post->title . '.' . $extension;
                       $post->image = $filename;
                       $files->move(public_path('images/post'), $filename);
                   }
               }
       
               $post->type = $request->type; //form
               $post->metakey = $request->metakey; //form
               $post->metadesc = $request->metadesc; //form
               
               $post->created_at = date('Y-m-d H:i:s');
               $post->created_by = 1;
               $post->status = $request->status; //form
               $post->save(); //lưu vào Csdl
               return response()->json(
                   ['success' => true, 'message' => 'Thành công', 'post' => $post],
                   201
               );
           }
           //post-update
           public function update(Request $request, $id)
       
           {
       
               $post = Post::find($id);
            //    $post->discription = $request->discription; //form

               $post->topic_id = $request->topic_id; //form
               $post->title = $request->title; //form
               $post->slug = Str::of($request->title)->slug('-');
               $post->detail = $request->detail; //form
               //$post->image=$request->name;//xử lý riêng
               $files = $request->image;
               if ($files != null) {
                   $extension = $files->getClientOriginalExtension();
                   if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                       $filename = $post->title . '.' . $extension;
                       $post->image = $filename;
                       $files->move(public_path('images/post'), $filegetname);
                   }
               }
       
               $post->type = $request->type; //form
               $post->metakey = $request->metakey; //form
               $post->metadesc = $request->metadesc; //form
       
               $post->updated_at = date('Y-m-d H:i:s');
       
               $post->updated_by = 1; //tạm cho =1
       
               $post->status = $request->status; //form
       
               $post->save(); //Luuu vao CSDL
       
               return response()->json(
       
                   ['success' => true, 'message' => 'Thành công', 'post' => $post],
       
                   200
       
               );
           }
    // xóa khỏi CSDL
    public function destroy($id){
        $post = Post::where([['id','=',$id],['status','=',0]])->first();
        if ($post == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
    
        $post ->delete();
        return response()->json(['message'=> 'Xóa khỏi CSDL thành công','success'=>true,'id'=>$id],200);
    }
//xóa tạm
    public function delete($id){
        $post = Post::find($id);
        if($post == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
        // $count_orderid = Orderdetail::where('order_id','=',$id)->count();
        // if($count_orderid > 0){
        //     return response()->json(['success' => false, 'message' =>'Thương hiệu có sản phẩm không thể xóa !']);
        // }
        $post->status = 0;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa sản phẩm vào thùng rác !']);
    }
//khôi phuc
    public function restore($id){
        $post = Post::find($id);
        if($post == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
        $post->status = 1;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa phục hồi sản phẩm !']);
    }

           public function get_byPagePo($limit, $page = 1)  // phân trang
        { 
             $countAll = Post::where('status','!=',0)->count();
             $post = Post::where('type','==','post')->get();

                $end_page = 1;
                if ($countAll > $limit) {
                    $end_page = ceil($countAll / $limit);
                }    
                $offset = ($page - 1) * $limit;
     
                $post = Post::orderBy("created_at", "DESC")
                ->offset($offset)
                ->limit($limit)
                ->where('status', 1)
                ->where('type', 'post')

                ->get();
               
            return response()->json(
     
                ['success' => true, 'message' => "tai du lieu thanh cong", 'posts' => $post,
                'end'=>$end_page
            ],
     
                200
     
            );
        }



        public function get_byPagePa($limit, $page = 1)  // phân trang
        { 
             $countAll = Post::where('status','!=',0)->count();
             $post = Post::where('type','==','footer')->get();

                $end_page = 1;
                if ($countAll > $limit) {
                    $end_page = ceil($countAll / $limit);
                }    
                $offset = ($page - 1) * $limit;
     
                $post = Post::orderBy("created_at", "DESC")
                ->offset($offset)
                ->limit($limit)
                ->where('status', 1)
                ->where('type', 'footer')

                ->get();
               
            return response()->json(
     
                ['success' => true, 'message' => "tai du lieu thanh cong", 'posts' => $post,
                'end'=>$end_page
            ],
     
                200
     
            );
        }


        public function getlistRestore($limit, $page = 1)  // phân trang
        { 
             $countAll = Post::where('status','!=',1)->count();
             $post = Post::where('type','!=','footer')->get();

                $end_page = 1;
                if ($countAll > $limit) {
                    $end_page = ceil($countAll / $limit);
                }    
                $offset = ($page - 1) * $limit;
     
                $post = Post::orderBy("created_at", "DESC")
                ->offset($offset)
                ->limit($limit)
                ->where('status', 0)
                ->where('type', 'post')

                ->get();
               
            return response()->json(
     
                ['success' => true, 'message' => "tai du lieu thanh cong", 'posts' => $post,
                'end'=>$end_page
            ],
     
                200
     
            );
        }


        public function getlistRestorePa($limit, $page = 1)  // phân trang
        { 
             $countAll = Post::where('status','!=',1)->count();
             $post = Post::where('type','!=','post')->get();

                $end_page = 1;
                if ($countAll > $limit) {
                    $end_page = ceil($countAll / $limit);
                }    
                $offset = ($page - 1) * $limit;
     
                $post = Post::orderBy("created_at", "DESC")
                ->offset($offset)
                ->limit($limit)
                ->where('status', 0)
                ->where('type', 'footer')

                ->get();
               
            return response()->json(
     
                ['success' => true, 'message' => "tai du lieu thanh cong", 'posts' => $post,
                'end'=>$end_page
            ],
     
                200
     
            );
        }

}

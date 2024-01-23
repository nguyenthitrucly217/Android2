<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use App\Http\Controllers\Api\TopicController;

class TopicController extends Controller
{
           //Get ---topic/index
           public function index()

           {
       
               $topics = Topic::orderBy('created_at','DESC')
               ->where('status', 1)
               ->get();
               return response()->json(
       
                   ['success' => true, 'message' => 'Tải dữ liệu thành công', 'topics' => $topics],
       
                   200
       
               );
           }
           // Get -topic/show
           public function show($id)
       
           {
       
            if (is_numeric($id))
            {
                $topic = Topic:: findOrFail($id);
            }
            else
            {
                $topic = Topic::where ('slug',$id)->first();
            }
               return response()->json(
       
                   ['success' => true, 'message' => 'Tải dữ liệu thành công', 'topic' => $topic],
       
                   200
       
               );
           }

           //Post- them store
           public function store(Request $request)
           {
               $topic = new Topic();
               $topic->name = $request->name; //form
               $topic->slug = Str::of($request->name)->slug('-');
               $topic->metakey = $request->metakey; //form
               $topic->metadesc = $request->metadesc; //form
               $topic->parent_id=$request->parent_id;
               
               $topic->created_at = date('Y-m-d H:i:s');
               $topic->created_by = 1;
               $topic->status = $request->status; //form
               $topic->save(); //lưu vào Csdl
               return response()->json(
                   ['success' => true, 'message' => 'Thành công', 'topic' => $topic],
                   201
               );
           }
           //topic-update
           public function update(Request $request, $id)
       
           {
       
               $topic = Topic::find($id);
       
               $topic->name = $request->name; //form
       
               $topic->slug = Str::of($request->name)->slug('-');
              
               $topic->metakey = $request->metakey; //form
       
               $topic->metadesc = $request->metadesc; //form
               $topic->parent_id=$request->parent_id;
       
       
               $topic->updated_at = date('Y-m-d H:i:s');
       
               $topic->updated_by = 1; //takm cho =1
       
               $topic->status = $request->status; //form
       
               $topic->save(); //Luuu vao CSDL
       
               return response()->json(
       
                   ['success' => true, 'message' => 'Thành công', 'topic' => $topic],
       
                   200
       
               );
           }


    // xóa khoi csdl
    public function destroy($id){
        $topic = Topic::where([['id','=',$id],['status','=',0]])->first();
        if ($topic == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
    
        $topic ->delete();
        return response()->json(['message'=> 'Xóa khỏi CSDL thành công','success'=>true,'id'=>$id],200);
    }
//xóa tạm
    public function delete($id){
        $topic = Topic::find($id);
        if($topic == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
        $count_topicid = Post::where('topic_id','=',$id)->count();
        if($count_topicid > 0){
            return response()->json(['success' => false, 'message' =>'Chủ đề có bài viết không thể xóa !']);
        }
        $topic->status = 0;
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa sản phẩm vào thùng rác !']);
    }
//khôi phuc
    public function restore($id){
        $topic = Topic::find($id);
        if($topic == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
        $topic->status = 1;
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa phục hồi sản phẩm !']);
    }

    
           public function get_byPageTo($limit, $page = 1)  // phân trang
           { 
                $countAll = Topic::where('status','!=',0)->count();
                   $end_page = 1;
                   if ($countAll > $limit) {
                       $end_page = ceil($countAll / $limit);
                   }    
                   $offset = ($page - 1) * $limit;
        
                   $topic = Topic::orderBy("created_at", "DESC")
                   ->offset($offset)
                   ->limit($limit)
                   ->where('status', 1)
                   ->get();
                  
               return response()->json(
        
                   ['success' => true, 'message' => "tai du lieu thanh cong", 'topics' => $topic,
                   'end'=>$end_page
               ],
        
                   200
        
               );
           }



           public function getlistRestore($limit, $page = 1)  // phân trang
           { 
                $countAll = Topic::where('status','!=',1)->count();
                   $end_page = 1;
                   if ($countAll > $limit) {
                       $end_page = ceil($countAll / $limit);
                   }    
                   $offset = ($page - 1) * $limit;
        
                   $topic = Topic::orderBy("created_at", "DESC")
                   ->offset($offset)
                   ->limit($limit)
                   ->where('status', 0)
                   ->get();
                  
               return response()->json(
        
                   ['success' => true, 'message' => "tai du lieu thanh cong", 'topics' => $topic,
                   'end'=>$end_page
               ],
        
                   200
        
               );
           }


}

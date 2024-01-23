<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSale;
use App\Models\Category;
use Illuminate\Support\Str; 
use App\Http\Controllers\Api\ProductSaleController;



class ProductSaleController extends Controller
{
    // function product_sale( $limit,$type)
    // {
    //     $args = [
    //         ['type', '=', $type],
    //         ['status', '=', 1]
    //     ];
    //     $products = Product::where($args)
    //         ->orderBy('created_at', 'DESC')
    //         -> limit($limit)
    //         ->get();
    //     return response()->json(
    //         [
    //             'success' => true,
    //             'message' => 'Tải dữ liệu thành công',
    //             'products' => $products
    //         ],
    //         200
    //     );
    // }






    //PRODUCT_HOME
//     public function product_home($limit, $category_id = 0)
//     {
//         $listid = array();
//         array_push($listid, $category_id + 0);
//         $args_cat1 = [
//             ['parent_id', '=', $category_id + 0],
//             ['status', '=', 1]
//         ];
//         $list_category1 = Category::where($args_cat1)->get();
//         if (count($list_category1) > 0) {
//             foreach ($list_category1 as $row1) {
//                 array_push($listid, $row1->id);
//                 $args_cat2 = [
//                     ['parent_id', '=', $row1->id],
//                     ['status', '=', 1]
//                 ];
//                 $list_category2 = Category::where($args_cat2)->get();
//                 if (count($list_category2) > 0) {
//                     foreach ($list_category2 as $row2) {
//                         array_push($listid, $row2->id);
//                     }
//                 }
//             }
//         }
//         $products = Product::where('status','=', 1)
//             ->whereIn('category_id', $listid)
//             ->orderBy('created_at', 'DESC')
//             ->limit($limit)
//             ->get();
            
// if(count($products)){
//     return response()->json(
//         [
//             'success' => true,
//             'message' => 'Tải dữ liệu thành công',
//             'products' => $products
//         ],
//         200
//     );
// }
// else{
//     return response()->json(
//         [
//             'success' => false,
//             'message' => 'Không có dữ liệu',
//             'products' => null
//         ],
//        404
//     );
// }
// }

//TẤT CẢ SẢN PHẨM PRODUCT_ALL
// public function product_all($limit)
//     {
//         $products = Product::where('status','=', 1)
//             ->orderBy('created_at', 'DESC')
//             ->limit($limit)
//             ->get();
//         return response()->json(
//             [
//                 'success' => true,
//                 'message' => 'Tải dữ liệu thành công',
//                 'products' => $products
//             ],
//             200
//         );
//     }

//PRODUCT_DETAIL
// public function product_detail($slug)
// {
//     $product =Product::where ([['slug','=',$slug],['status','=',1]])->first();
//     if ($product==null){
//         return response()->json(
//             [
//                 'success' => false,
//                 'message' => 'Khong co du lieu',
//                 'products' =>null
//             ],
//             404
//         );
//     }
//     $listid = array();
//     array_push($listid, $product-> category_id);
//     $args_cat1 = [
//         ['parent_id', '=',$product->category_id],
//         ['status', '=', 1]
//     ];
//     $list_category1 = Category::where($args_cat1)->get();
//     if (count($list_category1) > 0) {
//         foreach ($list_category1 as $row1) {
//             array_push($listid, $row1->id);
//             $args_cat2 = [
//                 ['parent_id', '=', $row1->id],
//                 ['status', '=', 1]
//             ];
//             $list_category2 = Category::where($args_cat2)->get();
//             if (count($list_category2) > 0) {
//                 foreach ($list_category2 as $row2) {
//                     array_push($listid, $row2->id);
//                 }
//             }
//         }
//     }
//     $product_order = Product::where([['id','!=',$product->id],['status','=',1]])
//         ->whereIn('category_id', $listid)
//         ->orderBy('created_at', 'DESC')
//         ->limit(8)
//         ->get();
//         return response()->json(
//             [
//                 'success' => true,
//                 'message' => 'Tải dữ liệu thành công',
//                 'product' => $product,
//                 'product_order'=>$product_order,
//             ],
//             200
//         );
//     }
//PRODUCT_CATEGORY

    // public function product_category( $limit,$category_id)
    // {
    //     $listid = array();
    //     array_push($listid, $category_id + 0);
    //     $args_cat1 = [
    //         ['parent_id', '=', $category_id + 0],
    //         ['status', '=', 1]
    //     ];
    //     $list_category1 = Category::where($args_cat1)->get();
    //     if (count($list_category1) > 0) {
    //         foreach ($list_category1 as $row1) {
    //             array_push($listid, $row1->id);
    //             $args_cat2 = [
    //                 ['parent_id', '=', $row1->id],
    //                 ['status', '=', 1]
    //             ];
    //             $list_category2 = Category::where($args_cat2)->get();
    //             if (count($list_category2) > 0) {
    //                 foreach ($list_category2 as $row2) {
    //                     array_push($listid, $row2->id);
    //                 }
    //             }
    //         }
    //     }
    //     $products = Product::where('status', 1)
    //         ->whereIn('category_id', $listid)
    //         ->orderBy('created_at', 'DESC')
    //         ->limit($limit)
    //         ->get();
    //     return response()->json(
    //         [
    //             'success' => true,
    //             'message' => 'Tải dữ liệu thành công',
    //             'products' => $products
    //         ],
    //         200
    //     );
    // }
//PRODUCT_BRAND
    // public function product_brand($limit,$brand_id)
    // {
    //     $products = Product::where([['brand_id', '=', $brand_id], ['status', '=', 1]])
    //         ->orderBy('created_at', 'DESC')
    //         ->limit($limit)
    //         ->get();
    //     return response()->json(
    //         [
    //             'success' => true,
    //             'message' => 'Tải dữ liệu thành công',
    //             'products' => $products
    //         ],
    //         200
    //     );
    // }


    


     //Get ---product/index
     public function index()

     {
 
         $productsales = ProductSale::orderBy('created_at','DESC')->get();
 
         return response()->json(
 
             ['success' => true, 'message' => 'Tải dữ liệu thành công', 'productsales' => $productsales],
 
             200
 
         );
     }
     // Get -product/show
     public function show($id)
 
     {
 
         $productsale = ProductSale::find($id);
         if ($productsale == null){
            return response()->json(
                ['message'=>'Tải dữ liệu không thành công','success'=>false,'productsale'=>null],404
            );
        }
     return response()->json(
 
             ['success' => true, 'message' => 'Tải dữ liệu thành công', 'productsale' => $productsale],
 
             200
 
         );
     }
     //Post- them store
     public function store(Request $request)
     {
         $productsale = new ProductSale();
         $productsale->product_id=$request->product_id;
         $productsale->pricesale=($request->pricesale);

        $productsale->quantity=($request->quantity);
         $productsale->created_at = date('Y-m-d H:i:s');
         $productsale->date_begin = date('Y-m-d H:i:s');
         $productsale->date_end = date('Y-m-d H:i:s');


         $productsale->created_by = 1;
         $productsale->status = $request->status; //form
         $productsale->save(); //lưu vào Csdl
         return response()->json(
             ['success' => true, 'message' => 'Thành công', 'productsale' => $productsale],
         );
     }
     //product-update
     public function update(Request $request, $id)
 
     {
 
         $productsale = ProductSale::find($id);
         $productsale->product_id=$request->product_id;
         $productsale->pricesale=($request->pricesale);

        $productsale->quantity=($request->quantity);
         $productsale->date_begin = date('Y-m-d H:i:s');
         $productsale->date_end = date('Y-m-d H:i:s');
         $productsale->updated_at = date('Y-m-d H:i:s');
 
         $productsale->updated_by = 1; //takm cho =1
 
         $productsale->status = $request->status; //form
 
         $productsale->save(); //Luuu vao CSDL
 
         return response()->json(
 
             ['success' => true, 'message' => 'Thành công', 'productsale' => $productsale],
 
             200
 
         );
     }
    // xóa khỏi CSDL
    public function destroy($id){
        $productsale = ProductSale::where([['id','=',$id],['status','=',0]])->first();
        if ($productsale == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
    
        $productsale ->delete();
        return response()->json(['message'=> 'Xóa khỏi CSDL thành công','success'=>true,'id'=>$id],200);
    }
//xóa tạm
    public function delete($id){
        $productSale = ProductSale::find($id);
        if($productSale == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
        // $count_proid = Orderdetail::where('product_id','=',$id)->count();
        // if($count_proid > 0){
        //     return response()->json(['success' => false, 'message' =>'Sản phẩm đã bán không thể xóa !']);
        // }
        // $count_productid = ProductSale::where('product_id','=',$id)->count();
        // if($count_productid > 0){
        //     return response()->json(['success' => false, 'message' =>'Sản phẩm đang sale không thể xóa !']);
        // }
        // $count_prostore = ProductStore::where('product_id','=',$id)->count();
        // if($count_prostore > 0){
        //     return response()->json(['success' => false, 'message' =>'Còn sản phẩm không thể xóa !']);
        // }

        $productSale->status = 0;
        $productSale->updated_at = date('Y-m-d H:i:s');
        $productSale->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa sản phẩm vào thùng rác !']);
    }
//khôi phuc
    public function restore($id){
        $productSale = ProductSale::find($id);
        if($productSale == null){
            return response()->json(['success' => false, 'message' =>'Không tìm thấy sản phẩm !']);
        }
        $productSale->status = 1;
        $productSale->updated_at = date('Y-m-d H:i:s');
        $productSale->save();
        return response()->json(['success' => true, 'message' =>'Đã đưa phục hồi sản phẩm !']);
    }

    //  public function search_product($keyword){
    //  $products=Product::where([['name', 'like','%'.$keyword.'%'],['status','=',1]])
    //  ->orderBy('created_at','DESC')
    //  ->get();
    //  return response()->json(['success'=>true,'message'=>'Tải dữ liệu thành công','products'=>$products],200);
//    }
public function get_byPageSale($limit, $page = 1)  // phân trang
{ 
     $countAll = Productsale::where('status','!=',0)->count();
        $end_page = 1;
        if ($countAll > $limit) {
            $end_page = ceil($countAll / $limit);
        }    
        $offset = ($page - 1) * $limit;

        $productsale = Productsale::orderBy("created_at", "DESC")
        ->offset($offset)
        ->limit($limit)
        ->where('status', 1)
        ->get();
       
    return response()->json(

        ['success' => true, 'message' => "tai du lieu thanh cong", 'productsales' => $productsale,
        'end'=>$end_page
    ],

        200

    );
}

public function getlistRestore($limit, $page = 1)  // phân trang
{ 
     $countAll = Productsale::where('status','!=',1)->count();
        $end_page = 1;
        if ($countAll > $limit) {
            $end_page = ceil($countAll / $limit);
        }    
        $offset = ($page - 1) * $limit;

        $productsale = Productsale::orderBy("created_at", "DESC")
        ->offset($offset)
        ->limit($limit)
        ->where('status',0)
        ->get();
       
    return response()->json(

        ['success' => true, 'message' => "tai du lieu thanh cong", 'productsales' => $productsale,
        'end'=>$end_page
    ],

        200

    );
}

}

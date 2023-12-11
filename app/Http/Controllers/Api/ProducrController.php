<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProducrController extends Controller
{
    public function index(){
        $data = Product::with('cat')->orderby('id','Desc')->get();
        $success['date'] = $data;
        $success['success'] =true;

        return response()->json($success,200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' =>'required',
            'qty'   =>'required',
            'cat_id'    =>'required',
            // 'discount'  =>'required',
 
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
        }


        $pro = new Product();
      
        $pro->name = $request->name;
        $pro->price = $request->price;
        $pro->qty = $request->qty;
        $pro->cat_id = $request->cat_id;
        $pro->discount = $request->discount;

        $pro->save();


        $success['date'] = $pro;
        $success['success'] =true;

        return response()->json($success,200);
         
        // return response($Categorie, 200);
    }

    public function update(Request $request,$id)
    {
        $pro = Product::find($id);
        if (!$pro) {
            $false['success'] =false;
            $false['message'] ="the product not found";

            return response()->json($false,404);
        }

       
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'price' =>'required',
                'qty'   =>'required',
                'cat_id'    =>'required',
                
            ]);

            if ($validator->fails()) {
                $errors = $validator->getMessageBag()->all();
                return response()->json($errors, 400);
            }

            $pro->name = $request->name;
            $pro->price = $request->price;
            $pro->qty = $request->qty;
            $pro->cat_id = $request->cat_id;
            $pro->discount = $request->discount;

            $pro->save();

            $success['success'] =true;
            $success['data'] =$pro;

            return response()->json($success,200);
       


    }


    public function destroy($id)
    {

        $pro = Product::find($id);
        if (!$pro) {
            $false['success'] =false;
            $false['message'] ="the product not found";

            return response()->json($false,404);
        }


            $pro->delete();
            // return response('successfully', 200);
     
       
            $success['success'] =true;
            $success['message'] ="successfully";

            return response()->json($success,200);

    }
}

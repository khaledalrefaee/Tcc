<?php

namespace App\Http\Controllers\Api;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CatController extends Controller
{
    public function get_product($id)
    {
        $data = Categorie::where('id', $id)->with('pro')->first();
    
        if (!$data) {
            $false['success'] = false;
            $false['message'] = "The product not found";
    
            return response()->json($false, 404);
        }
    
        $success['data'] = $data;
        $success['success'] = true;
        return response()->json($success, 200);
    }

    public function index(){
        $data = Categorie::orderBy('id','Desc')->get();
        $success['date'] = $data;
        $success['success'] =true;

        return response()->json($success,200);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
       
 
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
        }


        $Categorie = new Categorie();
      
        $Categorie->name = $request->name;


        $Categorie->save();


        $success['date'] = $Categorie;
        $success['success'] =true;

        return response()->json($success,200);
         
        // return response($Categorie, 200);
    }

    public function update(Request $request,$id)
    {
        $Categorie = Categorie::find($id);
        if (!$Categorie) {
            $false['success'] =false;
            $false['message'] ="the cat not found";

            return response()->json($false,404);
        }

       
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                
            ]);

            if ($validator->fails()) {
                $errors = $validator->getMessageBag()->all();
                return response()->json($errors, 400);
            }

            $Categorie->name = $request->name;
    

            $Categorie->save();

            $success['success'] =true;
            $success['data'] =$Categorie;

            return response()->json($success,200);
       


    }


    public function destroy($id)
    {

        $Categorie = Categorie::find($id);
        if (!$Categorie) {
            $false['success'] =false;
            $false['message'] ="the cat not found";

            return response()->json($false,404);
        }


            $Categorie->delete();
            // return response('successfully', 200);
     
       
            $success['success'] =true;
            $success['message'] ="successfully";

            return response()->json($success,200);

    }
}

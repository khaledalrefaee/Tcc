<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $data = User::orderBy('id', 'Desc')->get();
        $success['date'] = $data;
        $success['success'] =true;

        return response()->json($success,200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' =>'required|email',
            'password'   =>'required|min:6',
            // 'discount'  =>'required',
 
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
        }


        $user = new User();
      
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = "user";
      

        $user->save();


        $success['date'] = $user;
        $success['success'] =true;

        return response()->json($success,200);
         
        // return response($Categorie, 200);
    }

    public function update(Request $request,$id)
    {
        $user = User::find($id);
        if (!$user) {
            $false['success'] =false;
            $false['message'] ="the User not found";

            return response()->json($false,404);
        }

       
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' =>'required|email',
                
            ]);

            if ($validator->fails()) {
                $errors = $validator->getMessageBag()->all();
                return response()->json($errors, 400);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }else{
                unset($user->password);
            }
          
    

            $user->save();

            $success['success'] =true;
            $success['data'] =$user;

            return response()->json($success,200);
       


    }


    public function destroy($id)
    {

        $user = User::find($id);
        if (!$user) {
            $false['success'] =false;
            $false['message'] ="the user not found";

            return response()->json($false,404);
        }


            $user->delete();
            // return response('successfully', 200);
     
       
            $success['success'] =true;
            $success['message'] ="successfully";

            return response()->json($success,200);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\Phonebook;
class PhonebookController extends Controller
{
    function OnInsert(Request $request){
         $one=$request->input("one");
         $two=$request->input("two");
         $name=$request->input("name");
         $email=$request->input("email");

        $token=$request->input("access_token");
        $key=env('TOKEN_KEY');
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
         $decoded_array=(array)$decoded;
        $user=  $decoded_array['user'];
		//return $user;
        $result=Phonebook::insert([
            'user_name'=>$user,
            'phone_number1'=>$one,
            'phone_number2'=>$two,
            'name'=>$name,
            'email'=>$email
        ]);
        if($result==true){
            return "Successfully inserted";
        }
        else{
            return "insert Fail ! Try again";
        }
        
          
       // return response()->json($decoded);
           
    
    }
	
	 function OnSelect(Request $request){
        $token=$request->input("access_token");
        $key=env('TOKEN_KEY');
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
         $decoded_array=(array)$decoded;
        $user=  $decoded_array['user'];
        $result=Phonebook::where("user_name",$user)->get();
        return $result;

    }
}

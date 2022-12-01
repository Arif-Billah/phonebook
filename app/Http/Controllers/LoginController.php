<?php

namespace App\Http\Controllers;
use App\Models\Registration;
use \Firebase\JWT\JWT;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	
	function TokenTest(){
		return "ok";
	}
    function OnLogin(Request $request){
		
        $username=$request->input('user_name');
		//return $username;
        $password=$request->input('password');
		 $userCount=Registration::where(['user_name'=>$username,'password'=>$password])->count();
		 
		      if($userCount==1){
              
                $key=env("TOKEN_KEY");
				  //return $key;
                $payload = array(
                    "site" => "http://demo.com",
                    "user" => $username,
                    "iat" => time(),
                    "exp" => time()+3600
                    
                );
                $jwt = JWT::encode($payload, $key, 'HS256');
                return response()->json(['token'=>$jwt, 'status'=> "Login success"]);
                


            }else{
                return "invalid username or password";
            }
		
	}	
		
}

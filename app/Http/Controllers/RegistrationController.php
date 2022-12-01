<?php

namespace App\Http\Controllers;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function onRegister(Request $request){
		    $firstName=$request->input('first_name');
            $lastName=$request->input('last_name');
            $city=$request->input('city');
            $username=$request->input('user_name');
            $password=$request->input('password');
            $gender=$request->input('gender');
			
			$userCount=Registration::where('user_name',$username)->count();
	        
	        if( $userCount!=0){
                return 'user already exist';
            }else{ 
                $result=Registration::insert([
                    'first_name'=> $firstName,
                    'last_name'=> $lastName,
                    'city'=> $city,
                    'user_name'=> $username,
                    'password'=> $password,
                    'gender'=> $gender

                ]);
                if($result==true){
                    return "Registration Successful";
                    
                }else{
                    return "Registration Fail";
                }

                

            
            }
			
		
	}
	
	
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest ; 
use Illuminate\Support\Facades\DB;
use App\User;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    
  public function process(ChangePasswordRequest $request)
  { 
  										//get record from db if greater then 0
   	return $this->getChangePasswordTableRow($request)->count() > 0
     ? $this->changePassword($request)  //Than change password 
   	 : $this->tokenNotFoundResponse() ; //else   Token not found
  }

  public function getChangePasswordTableRow($request)
  {

  	return DB::table('password_resets')->where([
    	'email' => $request->email , 
    	'token' => $request->resetToken]) ;
  }


  public function changePassword($request)
  {
  		$user = User::whereEmail($request->email)->first();
  		$user->update(['password' => $request->password]) ; 
  		//Note * if changed then delete  password_resets table Row 
  		// $this->getChangePasswordTableRow($request)->delete();  
  		    					//then response
  		return response()->json(['success' => 'Password Sucessfully Changed'],Response::HTTP_CREATED) ;

  }


  public function tokenNotFoundResponse()
  {
  	return response()->json(['error' => 'Token or Email is incorrect'],Response::HTTP_UNPROCESSABLE_ENTITY);
  }
}

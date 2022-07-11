<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PasswordResetController extends Controller
{


    public function send_reset_token(Request $request){
       
        $request->validate([
            'email'=>'required|email'
        ]);

     
        if(User::where('email',$request->email)->exists()){

            $userToken = new PasswordReset();
            $userToken->email = $request->email;
            // $userToken->token = rand(1000,9999);
            $userToken->token = substr(Str::uuid(),0,8);

            if(PasswordReset::where('email',$request->email)->exists()){
                // Delete all users where email is found
                PasswordReset::where('email',$request->email)->delete();
            }
               
                // Generate new token
                $userToken->save();
                    Mail::to($request->email)->send(new PasswordResetMail($userToken->token));
                    return response()->json([
                        'reset_status' => true,
                        'message' => 'Please check your email for reset token',
                        // 'token'=>$userToken
                    ], 200);      
          
        }else{

            return response()->json([
                'status' => 'error',
                'message' => "User does not exist"
            ], 400);
        }
    }


    public function confirm_reset_token($token){

        $token_check_status = PasswordReset::where('token',$token)->first();

        if($token_check_status){

            if($token_check_status->created_at->addMinutes(30)->isPast()){

                return response()->json([
                    'token_status' => false,
                ], 200);

            }

            return response()->json([
                'token_status'=>true,
                'useremail'=>$token_check_status->email
            ],200);

        }else{

            return response()->json([
                'token_status'=>false
            ],200);
        }
    }

    public function update_password(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            ],[
                'password.confirmed'=>'password mismatch'
            ]);

            if ($validator->fails())
            {
           
                return response(['errors'=>$validator->errors()->all()], 422);
            }
             

            $user = User::where('email',$request->email)->first();

            $user->password  = Hash::make($request->password);

            if($user->save()){

                    // get token from db
                PasswordReset::where('email',$request->email)->delete();

                return response()->json([
                    'status'=>'password reset successfully',
                    // 'message'=> Strings::PasswordUpdated()
                ],200);
            }


    }
}

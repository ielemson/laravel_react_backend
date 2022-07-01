<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\ContactInformation;
use ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function index(){
      // return request()->user()->id;
    return User::where('id',request()->user()->id)->with('contactinfo')->first();
      // return response()->json([
      //   'user'=>$user
      // ],200);
    }

    public function check(){
      return auth('sanctum')->check();
    }

    public function users(){
        // return UserResource::collection(User::all());
        return User::with('contactinfo')->get();
    }

    public function user($id){      
      return User::where('id',$id)->with('contactinfo')->first();
    }


    public function update(Request $request){
      {
        
        // return response($user, 200);
        $contactCheck = ContactInformation::where('user_id',$request->user()->id)->first();

        if($contactCheck){
          $contactCheck->address = $request->address;
          $contactCheck->postcode = $request->postcode;
          $contactCheck->city = $request->city;
          $contactCheck->country = $request->country;
          $contactCheck->aboutme = $request->aboutme;
          $contactCheck->save();
        }else{

          $contactinfo = new ContactInformation;
          $contactinfo->user_id = request()->user()->id;
          $contactinfo->address = $request->address;
          $contactinfo->postcode = $request->postcode;
          $contactinfo->city = $request->city;
          $contactinfo->country = $request->country;
          $contactinfo->aboutme = $request->aboutme;
          $contactinfo->save();
        }

        $userUpdate = User::where('id',$request->user()->id)->first();

        $userUpdate->fullname = $request->fullname;
        $userUpdate->username = $request->username;
        $userUpdate->email = $request->email;
        $userUpdate->save();
      }

    }

    public function update_user(REquest $request, $id){
       // return response($user, 200);
       $contactCheck = ContactInformation::where('user_id',$id)->first();

       if($contactCheck){
         $contactCheck->address = $request->address;
         $contactCheck->postcode = $request->postcode;
         $contactCheck->city = $request->city;
         $contactCheck->country = $request->country;
         $contactCheck->aboutme = $request->aboutme;
         $contactCheck->save();
       }else{

         $contactinfo = new ContactInformation;
         $contactinfo->user_id = $id;
         $contactinfo->address = $request->address;
         $contactinfo->postcode = $request->postcode;
         $contactinfo->city = $request->city;
         $contactinfo->country = $request->country;
         $contactinfo->aboutme = $request->aboutme;
         $contactinfo->save();
       }

       $userUpdate = User::where('id',$id)->first();

       $userUpdate->fullname = $request->fullname;
       $userUpdate->username = $request->username;
       $userUpdate->email = $request->email;
       $userUpdate->save();
    }


    public function upload_img(Request $request){

      $userUpdate = User::where('id',$request->user()->id)->first();
      $userUpdate->picture = $request->picture;
      $userUpdate->save();
      return $request;
    
    }

}

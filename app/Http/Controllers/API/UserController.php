<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ContactInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function index(){
    return User::where('id',request()->user()->id)->with('contactinfo')->first();
    }


    public function curUser(){
      return response()->json([
        'user'=> request()->user()
      ],200);
    }

    
    public function store(Request $request){
      $validator = Validator::make($request->all(), [
        'fullname' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'status' => 'required',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'nullable',
    ], [
        'fullname.required' => 'first field name is required',
        'username.required' => 'last field name is required',
        'email.unique' => 'User Email already exist',
    ]);

    if ($validator->fails()) {

        return response(['errors' => $validator->errors()->all()], 422);
    }

    $user = User::create([
        'fullname' => $request->fullname,
        'username' => $request->username,
        'active' => $request->status,
        'email' => $request->email,
        // 'picture' => 'default.jpg',
        'password' => Hash::make("abc12345"),
    ]);

     $user->assignRole('user');
    
     $contact = [
      'address' => $request->address,
      'postcode' => $request->postcode,
      'city' => $request->city,
      'country' => $request->country,
      'aboutme' => $request->aboutme
     ];

     if(!empty($contact)){
      $contactinfo = new ContactInformation;
      $contactinfo->user_id = $user->id;
      $contactinfo->save();
     }

        return response()->json(['status'=>true,'message' => 'User created,default password: abc12345'], 201);
    }

    public function check(Request $request,$token){

      return $request->bearerToken() === $token 
      ?
      response()->json(['isAuthenticated'=>true])
        :
      response()->json(['isAuthenticated'=>false]);
    }

    public function check_token(Request $request, $token=null){

      return $request->bearerToken() === $token 
      ?
      response()->json(['isAuthenticated'=>true])
        :
      response()->json(['isAuthenticated'=>false]);
      
      //  if($request->bearerToken() === $token){

      //   return response()->json([
      //     'isAuthenticated'=>true,
      //     'client_token'=>$token,
      //     'server_token'=>$request->bearerToken()
      //    ]);

      // }

      //   return response()->json([
      //     'isAuthenticated'=>false,
      //     'client_token'=>$token,
      //     'server_token'=>$request->bearerToken()
      //    ],200);
      
  }
    public function users(){
        // return UserResource::collection(User::all());

        return User::with('contactinfo')->get()->map(fn($user)=>[
          'id'=>$user->id,
          'fullname'=>$user->fullname,
          'username'=>$user->username,
          'email'=>$user->email,
          'active'=>$user->active,
          'picture'=>$user->picture,
          'role'=>$user->getRoleNames()[0],
          'permission'=>$user->getPermissionsViaRoles()->pluck('name'),
          'created_at'=>$user->created_at->format('M d Y'),
          'contact'=>$user->contactinfo
      ]);
      //   return response()->json([
      //     'users' => UserResource::collection(User::all())
      // ], 200);
      //   return User::with('contactinfo')->get();
    }

    public function user($id){      
      return User::where('id',$id)->with('contactinfo')->first();
    }

    // Current user update
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

    // User updat by admin
    public function update_user(Request $request, $id){
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
       $userUpdate->active = $request->status;
       $userUpdate->save();
    }


    public function upload_img(Request $request){

      $userUpdate = User::where('id',$request->user()->id)->first();
      $userUpdate->picture = $request->picture;
      $userUpdate->save();
      return $request;
    
    }

    public function destroy(Request $request)
    {
        if(User::where('id',$request->id)->first()){

          if ($request->id == Auth::user()->id) {
            return response()->json([
                'error'=>"You can not delete a loggedin user"
            ]);
        }
        
        if(request()->user()->getRoleNames()[0] != "admin"){

          return response()->json(['error'=>"Permission denied"]);
        }
        
        $user = User::where('id',$request->id)->first();
        $user->roles()->detach();
        $user->delete();
        return response()->json(['status'=>true]);

        }

        return response()->json(["error"=>"User not found"]);

    }


}

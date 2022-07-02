<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    public function create_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ], [
            'fullname.required' => 'first field name is required',
            'username.required' => 'last field name is required',
            'password.confirmed' => 'password mismatch',
        ]);

        if ($validator->fails()) {

            return response(['errors' => $validator->errors()->all()], 422);
        }

        $user = User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
         $user->assignRole('user');
        if ($user) {

            $user->api_token = $this->getApiToken($user);

        }
        return response()->json(['success' => 'Registration was success', 'user' => $user], 201);

        // return response()->json(['request'=>$request->all()]);
    }


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|min:8',
        ],);

        if ($validator->fails()) {

            return response(['errors' => $validator->errors()->all()], 422);
        }


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            $user = User::find(Auth::user()->id);
            $role = $user->getRoleNames()[0];
            // $permission = $user->getPermissionNames();
            $user->api_token = $this->getApiToken($user);
            return response()->json([
                'message' => 'Login success',
                'user' => $user,
                "role"=>$role,
                // "permissions"=>$permission

            ], 200);
        }else{
            return response()->json([
                'error'=>"invalid login credential"
            ],401);
        }
    }

    public function logout(Request $request)
    {
        if ($request->user()->tokens()) {
            $request->user()->tokens()->delete();
        }
        return response()->json([
            'success' => 'Logout successfully',
            'logout_status'=>true
        ], 200);
    }

    public function getApiToken(User $user)
    {
        if ($user->tokens()) {
            $user->tokens()->delete();
        }
        return $user->createToken($user->email)->plainTextToken;
    }
}

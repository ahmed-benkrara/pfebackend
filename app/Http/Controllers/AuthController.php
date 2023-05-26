<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginRequest $request){
        $request->validated();

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return $this->error('','Invalid email or password',401);
        }

        $user = User::where('email',$request->email)->first();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api token of '.$user->name)->plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request){
        $request->validated();
        $user = User::create([
            'fname' =>$request->fname, 
            'lname' => $request->lname,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);
        event(new Registered($user));
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api token of '.$user->name)->plainTextToken
        ]);
    }

    public function logout(){
        Auth::user()->currentAccessToken()->delete();
        return $this->success([
            'message' => 'user logged out successfully'
        ]);
    }
}

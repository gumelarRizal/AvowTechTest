<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request){
        //validate incoming request 
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            //return successful response
            return response()->json(['user' => $user, 'msg' => 'User baru berhasil di tambahkan'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['msg' => 'Error = '.$e.''], 409);
        }
    }

    public function login(Request $request){
        $this->validate($request,[
            'email'=>'required|string',
            'password'=>'required|string',
        ]);
        $cred = $request->only(['email','password']);
        if(!$token = Auth::attempt($cred)){
            return response()->json(['msg' => 'User tidak ditemukan'], 401);
        }
        return $this->respondWithToken($token);
    }
    //
}

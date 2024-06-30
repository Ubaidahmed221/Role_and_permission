<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function LoadLogin(){
        return view('login');
    }

    public function userLogin(Request $request){
        $userCreadials =   $request->only('email','password');
        if(Auth::attempt($userCreadials)){
            return redirect('/dashboard');

        }
        return back()->with('error','Email & Password is incorrect!');

    }

    public function dashboard(){

        return view('dashboard');
    }
    public function logout(Request $request){
        try{
            $request->session()->flush();
            Auth::logout();
            return response()->json(['success' => true]);

        }
        catch(\Exception $e){
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);

        }

    }
    public function loadRegister(){
        return view('register');
    }

    public function UserRegister(Request $request){
        try{
           $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users|max:255',
                'password' => 'required|min:6',
            ]);
           $role = role::where('name','User')->first();
            User::insert([
                'name' =>  $validatedData['name'],
                'email' =>  $validatedData['email'],
                'password' =>  Hash::make($validatedData['password']),
                'role_id' => $role ?  $role->id : 0

            ]);
            return back()->with('success','Registration Successfully');
        }
        catch(\Exception $e){
            return back()->with('error',$e->getMessage());

        }

    }
}

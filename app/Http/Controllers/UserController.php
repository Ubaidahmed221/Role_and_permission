<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\PermissionRoute;
use App\Models\role;
use App\Models\User;

class UserController extends Controller
{

    public function users(){
      $users =  User::with('role')->where('role_id','!=',1)->get();
      $roles =  role::where('name','!=','Super Admin')->get();

        return view('users',compact(['roles','users']));
    }
    public function createUsers(Request $request){
        try{
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users|max:255',
                'password' => 'required|min:6',
                'role' => 'required',
            ]);

            User::insert([
                'name' =>  $validatedData['name'],
                'email' =>  $validatedData['email'],
                'password' =>  Hash::make($validatedData['password']),
                'role_id' => $validatedData['role']

            ]);


               return response()->json([
                   'success' => true,
                   'msg' => 'User Created'
               ]);

           }
           catch(\Exception $e){
               return response()->json([
                   'success' => false,
                   'msg' => $e->getMessage()
               ]);
           }

    }
    public function updateUsers(Request $request){
        try{
            $validatedData = $request->validate([
                'id' => 'required',
                'name' => 'required',
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($request->id),
                ],
                'password' => 'nullable',
                'role' => 'required',
            ]);

         $user =  User::find($validatedData['id']);
         $oldEmail = $user->email;
         $user->name = $validatedData['name'];
         $user->email = $validatedData['email'];
         $user->role_id = $validatedData['role'];
         if(isset($validatedData['password'])){
            $user->password = Hash::make($validatedData['password']);

         }
         $user->save();
         if($oldEmail != $validatedData['email'] || $validatedData['password']){
            // mail send work
         }
               return response()->json([
                   'success' => true,
                   'msg' => 'User Update'
               ]);

           }
           catch(\Exception $e){
               return response()->json([
                   'success' => false,
                   'msg' => $e->getMessage()
               ]);
           }

    }

    public function deleteUsers(Request $request){
        try{
            $validatedData = $request->validate([
                'id' => 'required',
              
            ]);
            User::where('id',$validatedData['id'])->delete();

               return response()->json([
                   'success' => true,
                   'msg' => 'User Deleted'
               ]);

           }
           catch(\Exception $e){
               return response()->json([
                   'success' => false,
                   'msg' => $e->getMessage()
               ]);
           }

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\role;

class RoleController extends Controller
{
    public function manageRole(){
      $roles =  role::whereNotIn('name',['Super Admin'])->get();
        return view('manage-role',compact('roles'));
    }

    public function createRole(Request $request){
        try{
         $validatedData =   $request->validate([
                'role' => 'required | unique:roles,name|max:255'
            ]);
            role::create([
                'name' => $validatedData['role']
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Role Created'
            ]);

        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }
    public function deleterole(Request $request){
        try{

            role::where('id',$request->role_id)->delete();

            return response()->json([
                'success' => true,
                'msg' => 'Role Created'
            ]);

        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }
    public function updaterole(Request $request){
        try{

            role::where('id',$request->role_id)->update([
                'name' => $request->role
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Role Updated'
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

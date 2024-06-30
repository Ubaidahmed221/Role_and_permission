<?php

namespace App\Http\Controllers;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\PermissionRoute;
use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PermissionController extends Controller
{
    public function managePermission(){
        $permission =  Permission::all();
          return view('manage-permission',compact('permission'));
      }

      public function createPermission(Request $request){
          try{
           $validatedData =   $request->validate([
                  'permission_name' => 'required |unique:permission,name|max:255'
              ]);
         Permission::create([
                  'name' => $validatedData['permission_name']
              ]);

              return response()->json([
                  'success' => true,
                  'msg' => 'Permission Created'
              ]);

          }
          catch(\Exception $e){
              return response()->json([
                  'success' => false,
                  'msg' => $e->getMessage()
              ]);
          }
      }
      public function deletePermission(Request $request){
        try{

            Permission::where('id',$request->Permission_id)->delete();

            return response()->json([
                'success' => true,
                'msg' => 'Permission Deleted'
            ]);

        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }
    public function updatePermission(Request $request){
        try{

            Permission::where('id',$request->permission_id)->update([
                'name' => $request->permission
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Permission Updated'
            ]);

        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function assignPermissionRole(){

      $role = role::whereNotIn('name',['super Admin'])->get();
      $permission = Permission::all();

    $permissionwithrole = Permission::with('role')->whereHas('role')->get();

        return view('assign_permission_role',compact('role','permission','permissionwithrole'));
    }

    public function createPermissionRole(Request $request)
    {
        try {
            // Correct the where clause syntax
            $isExitPermissiontorole = PermissionRole::where([
                'permission_id' => $request->permission_id,
                'role_id' => $request->role_id
            ])->first();

            if ($isExitPermissiontorole) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Permission Is already Assigned to selected Role'
                ]);
            }

            // Create a new PermissionRole entry
            PermissionRole::create([
                'permission_id' => $request->permission_id,
                'role_id' => $request->role_id
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Permission Is Assigned To Selected Role!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function deletePermissionrole(Request $request){
        try{
            PermissionRole::where('permission_id', $request->permission_id)->delete();

            return response()->json([
                'success' => true,
                'msg' => 'delete Successfully'
            ]);

        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function assignPermissionRoute(){

      $routes =  Route::getRoutes();
      $middelwareGroup = 'IsAuthenticated';
      $routeDetail = [];
      foreach($routes as $route){
       $middlewares = $route->gatherMiddleware();
       if(in_array($middelwareGroup,$middlewares )){
        $routeName = $route->getName();

        if($routeName !== 'dashboard' && $routeName !== 'logout'){
        $routeDetail[] = [
            'name' =>  $routeName,
            'uri' => $route->uri()
        ];
        }
       }
      }
        $permission = Permission::all();
     $routerpermission =   PermissionRoute::with('permission')->get();
          return view('assign_permission_route',compact(['permission','routeDetail','routerpermission']));
      }

      public function createPermissionRoute(Request $request)
      {
          try {
              // Correct the where clause syntax
              $isExitPermission = PermissionRoute::where([
                  'permission_id' => $request->permission_id
              ])->first();

              if ($isExitPermission) {
                  return response()->json([
                      'success' => false,
                      'msg' => 'Permission Is already Assigned!'
                  ]);
              }

              // Create a new PermissionRole entry
              PermissionRoute::create([
                  'permission_id' => $request->permission_id,
                  'router' => $request->route
              ]);

              return response()->json([
                  'success' => true,
                  'msg' => 'Permission Is Assigned To Selected Route!'
              ]);
          } catch (\Exception $e) {
              return response()->json([
                  'success' => false,
                  'msg' => $e->getMessage()
              ]);
          }
      }
      public function updatePermissionRoute(Request $request)
      {
          try {
              // Correct the where clause syntax
              $isExitPermission = PermissionRoute::whereNotIn('id',[$request->id])
              ->where([
                  'permission_id' => $request->permission_id
              ])->first();
              $isExitrouter = PermissionRoute::whereNotIn('id',[$request->id])
              ->where([
                  'router' => $request->route
              ])->first();

              if ($isExitPermission) {
                  return response()->json([
                      'success' => false,
                      'msg' => 'Permission Is already Assigned!'
                  ]);
              }
             else if ($isExitrouter) {
                  return response()->json([
                      'success' => false,
                      'msg' => 'Route Is already Assigned!'
                  ]);
              }

              // Create a new PermissionRole entry
              PermissionRoute::where('id',$request->id)->update([
                  'permission_id' => $request->permission_id,
                  'router' => $request->route
              ]);

              return response()->json([
                  'success' => true,
                  'msg' => 'Permission Is  Updated To Selected Route!'
              ]);
          } catch (\Exception $e) {
              return response()->json([
                  'success' => false,
                  'msg' => $e->getMessage()
              ]);
          }
      }

      public function deletePermissionRoute(Request $request){
        try {

            // Create a new PermissionRole entry
            PermissionRoute::where('id',$request->id)->delete();

            return response()->json([
                'success' => true,
                'msg' => 'Permission Is  deleted of Route!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }

      }





}

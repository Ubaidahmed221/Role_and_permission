<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => ['guest']],function(){

    Route::get('/',[AuthController::class,'LoadLogin'])->name('loadLogin');
    Route::post('/',[AuthController::class,'userLogin'])->name('userlogin');
    Route::get('/register',[AuthController::class,'loadRegister'])->name('loadRegister');
    Route::post('/register',[AuthController::class,'UserRegister'])->name('UserRegister');
});

Route::group(['middleware' => ['IsAuthenticated']],function(){

    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');

    // manage role route
    Route::get('/manage-role',[RoleController::class,'manageRole'])->name('manageRole');
    Route::post('/create-role',[RoleController::class,'createRole'])->name('createRole');
    Route::post('/delete-role',[RoleController::class,'deleterole'])->name('deleterole');
    Route::post('/update-role',[RoleController::class,'updaterole'])->name('updaterole');

    // manage permission role
    Route::get('/manage-permission',[PermissionController::class,'managePermission'])->name('managePermission');
    Route::post('/create-permission',[PermissionController::class,'createPermission'])->name('createPermission');
    Route::post('/delete-permission',[PermissionController::class,'deletePermission'])->name('deletePermission');
    Route::post('/update-permission',[PermissionController::class,'updatePermission'])->name('updatePermission');

    // Assign Permission To role Routes
    Route::get('/assign-permission-role',[PermissionController::class,'assignPermissionRole'])->name('assignPermissionRole');
    Route::post('/create-permission-role',[PermissionController::class,'createPermissionRole'])->name('createPermissionRole');
    Route::post('/delete-permission-role',[PermissionController::class,'deletePermissionrole'])->name('deletePermissionrolese');

    // asign permission To Route
    Route::get('/assign-permission-route',[PermissionController::class,'assignPermissionRoute'])->name('assignPermissionRoute');
    Route::post('/create-permission-route',[PermissionController::class,'createPermissionRoute'])->name('createPermissionRoute');
    Route::post('/update-permission-route',[PermissionController::class,'updatePermissionRoute'])->name('updatePermissionRoute');
    Route::post('/delete-permission-route',[PermissionController::class,'deletePermissionRoute'])->name('deletePermissionRoute');

    // Manage User Route
    Route::get('/users',[UserController::class,'users'])->name('users');
    Route::post('/create-users',[UserController::class,'createUsers'])->name('CreateUsers');
    Route::post('/update-users',[UserController::class,'updateUsers'])->name('updateUsers');
    Route::post('/delete-users',[UserController::class,'deleteUsers'])->name('deleteUsers');



});



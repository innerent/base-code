<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'auth:api',
    'prefix' => ''
], function () {
    Route::apiResource('roles', 'RoleController');

    Route::get('permissions', function () {
        $permissions = \Spatie\Permission\Models\Permission::all()->toArray();

        return response()->json($permissions, 200);
    });
});

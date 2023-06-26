<?php

use App\Http\Controllers\Api\OrderItemsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\UserDetailsController;
use App\Http\Controllers\Api\WalletsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth']], function () {

});

Route::get('categories/parents', 'Api\CategoriesController@parents');
Route::get('categories/childs/{category_id}', 'Api\CategoriesController@childs');
Route::get('trends/tags', 'Api\TrendTagsController@tags');
Route::get('trends/all/sex/{sex}/tag/{tag}', 'Api\TrendsController@all');
Route::get('trends/view/{trend}', 'Api\TrendsController@view');
Route::get('textiles/filter', 'Api\TextilesController@filter');
Route::get('textiles/search/{start}/{step}', 'Api\TextilesController@search');
Route::get('textiles/last_discounts/{start}/{step}', 'Api\TextilesController@lastDiscounts');
Route::get('textiles/newers/{start}/{step}', 'Api\TextilesController@newers');
Route::get('textiles/view/{textile}', 'Api\TextilesController@view');


Route::post('users/register', 'Api\UsersController@register');
Route::post('users/login', 'Api\UsersController@login');
Route::post('users/logout', 'Api\UsersController@logout');
Route::post('users/verify', 'Api\UsersController@verify');
Route::get('faqs/list', 'Api\FaqsController@list');
Route::get('faqs/view/{faq}', 'Api\FaqsController@view');
Route::get('explorers/list', 'Api\ExplorersController@list');
Route::get('provinces/list', 'Api\ProvincesController@list');
Route::get('cities/list/{province_id}', 'Api\CitiesController@list');
Route::get('blogs/list', 'Api\BlogsController@list');
Route::get('blogs/view/{blog}', 'Api\BlogsController@view');
Route::post('wallets/verify/{transaction_id}/{sum_price}',['as' => 'wallet.api.verify', 'uses' => 'Api\WalletsController@verify']);
Route::post('orders/verify/{transaction_id}/{sum_price}/{ordercode}/{order_id}',['as' => 'order.api.verify', 'uses' => 'Api\OrdersController@verify']);

Route::post('users/forget_send_sms', 'Api\UsersController@forget_send_sms');
Route::post('users/verify_forget', 'Api\UsersController@verify_forget');

Route::group([
    'middleware' => 'auth:api',
    //'prefix' => 'users'
], function ($router) {
    Route::post('users/refresh', [UsersController::class, 'refresh']);
    Route::get('users/user-profile', [UsersController::class, 'userProfile']);
    Route::post('users/change-name', [UsersController::class, 'changeName']);
    Route::post('users/change-user_name', [UsersController::class, 'changeUserName']);
    Route::post('users/change-email', [UsersController::class, 'changeEmail']);
    Route::post('users/change-mobile', [UsersController::class, 'changeMobile']);
    Route::post('orders/save', [OrdersController::class, 'save']);
    Route::get('orders/list', [OrdersController::class, 'list']);
    Route::get('userdetails/addresses', [UserDetailsController::class, 'addresses']);
    Route::post('userdetails/delete', [UserDetailsController::class, 'delete']);
    Route::post('userdetails/select_address', [UserDetailsController::class, 'select_address']);
    Route::get('userdetails/get/{userdetail}', [UserDetailsController::class, 'get']);
    Route::post('userdetails/update', [UserDetailsController::class, 'update']);
    Route::post('userdetails/store', [UserDetailsController::class, 'store']);
    Route::get('userdetails/current_address', [UserDetailsController::class, 'current_address']);
    Route::post('users/change-password', [UsersController::class, 'change_password']);

    Route::get('wallets/get', [WalletsController::class, 'get']);
    Route::post('wallets/add', [WalletsController::class, 'add']);

    Route::get('orderitems/list/{order_id}', [OrderItemsController::class, 'list']);
    Route::post('users/profileImage', [UsersController::class, 'profileImage']);
});




Route::get('/basedata', function () {
    return response()->json(['link'=>'','update'=>['force'=>0,'version' => 1,'download' => ''],'success'=>1], 200);
});

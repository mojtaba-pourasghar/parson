<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'Mobile\HomeController@index']);
/*
Route::get('/', function () {
    return 'welcome';
});*/

Auth::routes();
Route::get('users/email/verify/{confirmation}', ['as' => 'user.email_confirmation', 'uses' => 'UsersController@email_confirmation']);

Route::group(['middleware' => ['auth']], function () {
    Route::match(array('GET', 'PUT'), 'users/edit', ['as' => 'user.edit', 'uses' => 'UsersController@edit_profile']);
    Route::match(array('GET', 'PUT'), 'users/change_password', ['as' => 'user.change_password', 'uses' => 'UsersController@change_password']);
    Route::match(array('GET', 'PUT'), 'users/change_mobile', ['as' => 'user.change_mobile', 'uses' => 'UsersController@change_mobile']);

    Route::get('cities/get/{province_id}/{city_id}',['as' => 'city.list', 'uses' => 'CitiesController@get']);
    Route::get('profile',['as' => 'user.myProfile', 'uses' => 'UsersController@myProfile']);
    Route::post('blogcomments/add/{book_id}',['as' => 'blogcomment.add', 'uses' => 'BlogCommentsController@add']);
    Route::get('blogcomments/showModal/{id}',['as' => 'blogcomment.modal', 'uses' => 'BlogCommentsController@showModal']);
    Route::get('blogcommentreports/showModal/{id}',['as' => 'blogcommentreport.modal', 'uses' => 'BlogCommentReportsController@showModal']);
    Route::post('blogcommentreports/add',['as' => 'blogcommentreport.add', 'uses' => 'BlogCommentReportsController@add']);
    Route::put('blogcomments/update/{id}',['as' => 'blogcomment.update', 'uses' => 'BlogCommentsController@update']);

    Route::get('orders/list',['as' => 'order.list', 'uses' => 'OrdersController@list']);
    Route::get('orderitems/list/{order_id}',['as' => 'orderitems.list', 'uses' => 'OrderItemsController@list']);
    Route::match(array('GET', 'PUT'), 'users/change-password', ['as' => 'user.change_password', 'uses' => 'UsersController@change_password']);
    Route::match(array('GET', 'PUT'), 'users/change-image', ['as' => 'user.change_image', 'uses' => 'UsersController@change_image']);
    Route::get('userdetails/addresses', ['as' => 'userdetail.addresses', 'uses' => 'UserDetailsController@addresses']);
    Route::match(array('GET', 'POST'), 'userdetails/add', ['as' => 'userdetail.add', 'uses' => 'UserDetailsController@add']);
    Route::match(array('GET', 'PUT'), 'userdetails/edit/{id}', ['as' => 'userdetail.edit', 'uses' => 'UserDetailsController@edit']);
    Route::get('userdetails/delete/{id}',['as' => 'userdetail.delete', 'uses' => 'UserDetailsController@delete']);
    Route::post('userdetails/select_address',['as' => 'userdetail.select_address', 'uses' => 'UserDetailsController@select_address']);

    Route::get('baskets/list',['as' => 'basket.list', 'uses' => 'BasketController@list']);
    Route::get('baskets/delete/{id}',['as' => 'basket.delete', 'uses' => 'BasketController@delete']);

    Route::get('orders/step1',['as' => 'order.step1', 'uses' => 'OrdersController@step1']);
    Route::get('orders/step2',['as' => 'order.step2', 'uses' => 'OrdersController@step2']);

    Route::post('bookmarks/add',['as' => 'bookmark.add', 'uses' => 'BookmarkController@add']);
    Route::get('bookmarks/list',['as' => 'bookmark.list', 'uses' => 'BookmarkController@list']);
    Route::get('bookmarks/delete/{id}',['as' => 'bookmark.delete', 'uses' => 'BookmarkController@delete']);

    Route::match(array('GET', 'POST'), 'wallets/add', ['as' => 'wallet.add', 'uses' => 'WalletsController@add']);
    Route::match(array('GET', 'POST'),'wallets/gateway',['as' => 'wallet.gateway', 'uses' => 'WalletsController@gateway']);
    Route::post('wallets/verify',['as' => 'wallet.verify', 'uses' => 'WalletsController@verify']);
    Route::post('orders/save',['as' => 'order.save', 'uses' => 'OrdersController@save']);
    Route::post('orders/step3',['as' => 'order.step3', 'uses' => 'OrdersController@step3']);
    Route::get('users/setting',['as' => 'user.setting', 'uses' => 'Mobile\UsersController@setting']);
    Route::post('users/edit_single',['as' => 'user.edit_single', 'uses' => 'Mobile\UsersController@edit_single']);
});


Route::get('admin/profile', function () {
    //
})->middleware('auth');

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

Route::get('google', function () {
    return view('googleAuth');
});
/*
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');*/
Route::get('categories/search',['as' => 'categories.search', 'uses' => 'CategoriesController@search']);
Route::get('user/{id}-{title}',['as' => 'user.profile', 'uses' => 'UsersController@profile']);
Route::get('blog/{id}-{title}', ['as' => 'blog.view', 'uses' => 'BlogsController@view']);
Route::get('blog/news', ['as' => 'blog.news', 'uses' => 'BlogsController@news']);
Route::get('blogcomments/get/{blog_id}',['as' => 'blogcomment.get', 'uses' => 'BlogCommentsController@get']);
Route::match(array('GET', 'PUT'), 'users/mobile_verify/{mobile}', ['as' => 'user.mobile_verify', 'uses' => 'UsersController@mobile_verify']);
Route::get('textile/{id}-{title}', ['as' => 'textile.view', 'uses' => 'TextilesController@view']);
Route::get('textiles/search_filter',['as' => 'textile.search_filter', 'uses' => 'TextilesController@search_filter']);
Route::get('textiles/search',['as' => 'textile.search', 'uses' => 'TextilesController@search']);
Route::post('baskets/add',['as' => 'basket.add', 'uses' => 'BasketController@add']);
Route::get('baskets/refresh',['as' => 'basket.refresh', 'uses' => 'BasketController@refresh']);
Route::get('trend/{id}-{title}', ['as' => 'trend.view', 'uses' => 'TrendsController@view']);
Route::get('trends/last/sex/{sex}/tag/{tag}', ['as' => 'trend.last', 'uses' => 'TrendsController@last']);
Route::get('faqs/list', ['as' => 'faq.list', 'uses' => 'FaqsController@list']);
Route::match(array('GET', 'POST'), 'users/new_password', ['as' => 'user.new_password', 'uses' => 'Mobile\UsersController@new_password']);
Route::match(array('GET', 'POST'), 'users/send_password', ['as' => 'user.send_password', 'uses' => 'Mobile\UsersController@send_password']);



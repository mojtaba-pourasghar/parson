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
Route::get('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('auth/password', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.request');
Route::post('auth/password', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.email');

Route::get('backend/dashbord', ['as' => 'backend.dashbord', 'uses' => 'Backend\DashbordController@index']);

Route::resource('backend/roles', 'Backend\RolesController', ['as' => 'backend']);
Route::get('backend/roles/{roles}/delete', ['as' => 'backend.roles.delete', 'uses' => 'Backend\RolesController@delete']);

Route::resource('backend/users', 'Backend\UsersController', ['as' => 'backend']);
Route::get('backend/users/{users}/delete', ['as' => 'backend.users.delete', 'uses' => 'Backend\UsersController@delete']);
Route::get('backend/users', ['as' => 'backend.users.index', 'uses' => 'Backend\UsersController@index']);
Route::post('backend/users', ['as' => 'backend.users.index', 'uses' => 'Backend\UsersController@index']);
Route::post('backend/users/store', ['as' => 'backend.users.store', 'uses' => 'Backend\UsersController@store']);

Route::resource('backend/categories', 'Backend\CategoriesController', ['as' => 'backend']);
Route::get('backend/categories/{categories}/delete', ['as' => 'backend.categories.delete', 'uses' => 'Backend\CategoriesController@delete']);
Route::get('backend/categories', ['as' => 'backend.categories.index', 'uses' => 'Backend\CategoriesController@index']);
Route::get('backend/categories', ['as' => 'backend.categories.index', 'uses' => 'Backend\CategoriesController@index']);
Route::post('backend/categories/store', ['as' => 'backend.categories.store', 'uses' => 'Backend\CategoriesController@store']);
Route::get('backend/categories/{deo_code}/getdeotitle', ['as' => 'backend.categories.getdeotitle', 'uses' => 'Backend\CategoriesController@getdeotitle']);

Route::resource('backend/pages', 'Backend\PagesController', ['as' => 'backend']);
Route::get('backend/pages/{pages}/delete', ['as' => 'backend.pages.delete', 'uses' => 'Backend\PagesController@delete']);
Route::get('backend/pages', ['as' => 'backend.pages.index', 'uses' => 'Backend\PagesController@index']);
Route::post('backend/pages/store', ['as' => 'backend.pages.store', 'uses' => 'Backend\PagesController@store']);

Route::resource('backend/blogs', 'Backend\BlogsController', ['as' => 'backend']);
Route::get('backend/blogs/{blogs}/delete', ['as' => 'backend.blogs.delete', 'uses' => 'Backend\BlogsController@delete']);
Route::get('backend/blogs', ['as' => 'backend.blogs.index', 'uses' => 'Backend\BlogsController@index']);
Route::post('backend/blogs/store', ['as' => 'backend.blogs.store', 'uses' => 'Backend\BlogsController@store']);

Route::resource('backend/blogtags', 'Backend\BlogTagsController', ['as' => 'backend']);
Route::get('backend/blogtags/{blogtags}/delete', ['as' => 'backend.blogtags.delete', 'uses' => 'Backend\BlogTagsController@delete']);
Route::get('backend/blogtags', ['as' => 'backend.blogtags.index', 'uses' => 'Backend\BlogTagsController@index']);
Route::post('backend/blogtags/store', ['as' => 'backend.blogtags.store', 'uses' => 'Backend\BlogTagsController@store']);

Route::get('backend/blogs/{blog}/blogcomments', ['as' => 'backend.blogcomments.index', 'uses' => 'Backend\BlogCommentsController@index']);
Route::put('backend/blogcomments/{blog}/update/{blogcomment}', ['as' => 'backend.blogcomments.update', 'uses' => 'Backend\BlogCommentsController@update']);
Route::get('backend/blogcomments/{blog}/edit/{blogcomment}', ['as' => 'backend.blogcomments.edit', 'uses' => 'Backend\BlogCommentsController@edit']);
Route::get('backend/blogcomments/{blog}/delete/{blogcomments}', ['as' => 'backend.blogcomments.delete', 'uses' => 'Backend\BlogCommentsController@delete']);

Route::resource('backend/trends', 'Backend\TrendsController', ['as' => 'backend']);
Route::get('backend/trends/{trends}/delete', ['as' => 'backend.trends.delete', 'uses' => 'Backend\TrendsController@delete']);
Route::get('backend/trends', ['as' => 'backend.trends.index', 'uses' => 'Backend\TrendsController@index']);
Route::post('backend/trends/store', ['as' => 'backend.trends.store', 'uses' => 'Backend\TrendsController@store']);

Route::resource('backend/trendtags', 'Backend\TrendTagsController', ['as' => 'backend']);
Route::get('backend/trendtags/{trendtags}/delete', ['as' => 'backend.trendtags.delete', 'uses' => 'Backend\TrendTagsController@delete']);
Route::get('backend/trendtags', ['as' => 'backend.trendtags.index', 'uses' => 'Backend\TrendTagsController@index']);
Route::post('backend/trendtags/store', ['as' => 'backend.trendtags.store', 'uses' => 'Backend\TrendTagsController@store']);

Route::resource('backend/trendcategories', 'Backend\TrendCategoriesController', ['as' => 'backend']);
Route::get('backend/trendcategories/{trendcategories}/delete', ['as' => 'backend.trendcategories.delete', 'uses' => 'Backend\TrendCategoriesController@delete']);
Route::get('backend/trendcategories', ['as' => 'backend.trendcategories.index', 'uses' => 'Backend\TrendCategoriesController@index']);
Route::post('backend/trendcategories/store', ['as' => 'backend.trendcategories.store', 'uses' => 'Backend\TrendCategoriesController@store']);


Route::resource('backend/textiles', 'Backend\TextilesController', ['as' => 'backend']);
Route::get('backend/textiles/{textiles}/delete', ['as' => 'backend.textiles.delete', 'uses' => 'Backend\TextilesController@delete']);
Route::get('backend/textiles', ['as' => 'backend.textiles.index', 'uses' => 'Backend\TextilesController@index']);
Route::post('backend/textiles/store', ['as' => 'backend.textiles.store', 'uses' => 'Backend\TextilesController@store']);

Route::resource('backend/textiletypes', 'Backend\TextileTypesController', ['as' => 'backend']);
Route::get('backend/textiletypes/{textiletypes}/delete', ['as' => 'backend.textiletypes.delete', 'uses' => 'Backend\TextileTypesController@delete']);
Route::get('backend/textiletypes', ['as' => 'backend.textiletypes.index', 'uses' => 'Backend\TextileTypesController@index']);
Route::post('backend/textiletypes/store', ['as' => 'backend.textiletypes.store', 'uses' => 'Backend\TextileTypesController@store']);

Route::resource('backend/discounttypes', 'Backend\DiscountTypesController', ['as' => 'backend']);
Route::get('backend/discounttypes/{discounttypes}/delete', ['as' => 'backend.discounttypes.delete', 'uses' => 'Backend\DiscountTypesController@delete']);
Route::get('backend/discounttypes', ['as' => 'backend.discounttypes.index', 'uses' => 'Backend\DiscountTypesController@index']);
Route::post('backend/discounttypes/store', ['as' => 'backend.discounttypes.store', 'uses' => 'Backend\DiscountTypesController@store']);

Route::resource('backend/orders', 'Backend\OrdersController', ['as' => 'backend']);
Route::get('backend/orders/{orders}/delete', ['as' => 'backend.orders.delete', 'uses' => 'Backend\OrdersController@delete']);
//Route::get('backend/orders', ['as' => 'backend.orders.index', 'uses' => 'Backend\OrdersController@index']);
Route::match(array('GET', 'POST'), 'backend/orders', ['as' => 'backend.orders.index', 'uses' => 'Backend\OrdersController@index']);
Route::post('backend/orders/store', ['as' => 'backend.orders.store', 'uses' => 'Backend\OrdersController@store']);
Route::get('backend/orderitems/print/{order_id}', ['as' => 'backend.orderitems.print', 'uses' => 'Backend\OrderItemsController@print']);
Route::get('backend/orderitems/list/{order_id}',['as' => 'backend.orderitems.list', 'uses' => 'Backend\OrderItemsController@list']);

Route::get('backend/users/{users}/getusers', ['as' => 'backend.users.getusers', 'uses' => 'Backend\UsersController@getusers']);

Route::put('backend/siteinformations/update', ['as' => 'backend.siteinformations.update', 'uses' => 'Backend\SiteInformationsController@update']);
Route::get('backend/siteinformations/edit', ['as' => 'backend.siteinformations.edit', 'uses' => 'Backend\SiteInformationsController@edit']);

Route::get('backend/userimages/index', ['as' => 'backend.userimages.index', 'uses' => 'Backend\UserImagesController@index']);
Route::get('backend/userimages/confirmation/{user_id}', ['as' => 'backend.userimages.confirmation', 'uses' => 'Backend\UserImagesController@confirmation']);
Route::get('backend/userimages/delete/{user_id}', ['as' => 'backend.userimages.delete', 'uses' => 'Backend\UserImagesController@delete']);

Route::resource('backend/faqs', 'Backend\FaqsController', ['as' => 'backend']);
Route::get('backend/faqs/{faqs}/delete', ['as' => 'backend.faqs.delete', 'uses' => 'Backend\FaqsController@delete']);
Route::get('backend/faqs', ['as' => 'backend.faqs.index', 'uses' => 'Backend\FaqsController@index']);
Route::post('backend/faqs/store', ['as' => 'backend.faqs.store', 'uses' => 'Backend\FaqsController@store']);

Route::resource('backend/pricepatterns', 'Backend\PricePatternsController', ['as' => 'backend']);
Route::get('backend/pricepatterns/{pricepatterns}/delete', ['as' => 'backend.pricepatterns.delete', 'uses' => 'Backend\PricePatternsController@delete']);
Route::get('backend/pricepatterns', ['as' => 'backend.pricepatterns.index', 'uses' => 'Backend\PricePatternsController@index']);
Route::post('backend/pricepatterns/store', ['as' => 'backend.pricepatterns.store', 'uses' => 'Backend\PricePatternsController@store']);
Route::get('backend/pricepatterns/{id}/get', ['as' => 'backend.pricepatterns.get', 'uses' => 'Backend\PricePatternsController@get']);

Route::resource('backend/hashtags', 'Backend\HashTagsController', ['as' => 'backend']);
Route::get('backend/hashtags/{hashtags}/delete', ['as' => 'backend.hashtags.delete', 'uses' => 'Backend\HashTagsController@delete']);
Route::get('backend/hashtags', ['as' => 'backend.hashtags.index', 'uses' => 'Backend\HashTagsController@index']);
Route::post('backend/hashtags/store', ['as' => 'backend.hashtags.store', 'uses' => 'Backend\HashTagsController@store']);

Route::resource('backend/sliders', 'Backend\SlidersController', ['as' => 'backend']);
Route::get('backend/sliders/{sliders}/delete', ['as' => 'backend.sliders.delete', 'uses' => 'Backend\SlidersController@delete']);
Route::get('backend/sliders', ['as' => 'backend.sliders.index', 'uses' => 'Backend\SlidersController@index']);
Route::post('backend/sliders/store', ['as' => 'backend.sliders.store', 'uses' => 'Backend\SlidersController@store']);

/*
Route::get('/', function () {
    return view('welcome');
});*/
Route::get('backend/login', ['as' => 'backend.login','uses' => 'Backend\Auth\LoginController@showLoginForm']);
Route::post('backend/login', ['as' => 'backend.login','uses' => 'Backend\Auth\LoginController@login']);
Route::get('backend/logout', ['as' => 'backend.logout','uses' => 'Backend\Auth\LoginController@logout']);
//Auth::routes();

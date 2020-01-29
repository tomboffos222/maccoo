<?php
//User
Route::get('/','UserController@Home')->name('Home');
Route::get('/shop','UserController@Shop')->name('shop');
Route::get('register/page','UserController@RegisterPage')->name('RegisterPage');
Route::post('register','UserController@Register')->name('Register');
Route::get('login/page','UserController@LoginPage')->name('LoginPage');
Route::post('login','UserController@Login')->name('Login');
Route::get('shop/{productId?}','UserController@Product')->name('Product');
Route::get('author','UserController@Authors')->name('Authors');
Route::get('author/{authorId?}','UserController@Author')->name('Author');
Route::get('shop/cateogy/{categoryId?}','UserController@Category')->name('Category');
Route::get('search/','UserController@Search')->name('Search');

Route::middleware(['userCheck'])->group(function () {
    Route::get('Main','UserController@Main')->name('Main');
    Route::get('out','UserController@Out')->name('Out');
    Route::get('tree/{userId?}','UserController@Tree')->name('Tree');
    Route::get('setting/edit', 'UserController@Edit')->name('Edit');
    Route::get('setting/edit/user','UserController@EditUser')->name('EditUser');
    Route::get('message/page','UserController@MessagePage')->name('MessagePage');
    Route::get('message/send','UserController@MessageSend')->name('MessageSend');
    Route::get('account','UserController@Account')->name('Account');
    Route::get('status/up', 'UserController@Up')->name('Up');
    Route::get('account/up','UserController@AccountUp')->name('AccountUp');

});



//Admin
Route::get('admin','AdminController@LoginPage')->name('admin.LoginPage');
Route::post('admin/login','AdminController@Login')->name('admin.Login');

Route::group(['prefix' => 'admin', 'middleware' => 'adminCheck', 'name' => 'check'], function(){

});

Route::name('admin.')->prefix('admin')->middleware(['adminCheck'])->group(function () {
    Route::get('users','AdminController@Users')->name('Users');
    Route::get('out','AdminController@Out')->name('Out');
    Route::post('RegisterUser','AdminController@RegisterUser')->name('RegisterUser');
    Route::get('tree/{userId?}','AdminController@Tree')->name('Tree');
    Route::get('RejectUser/{userId}','AdminController@RejectUser')->name('RejectUser');
    Route::get('blacklist/','AdminController@BlackList')->name('BlackList');
    Route::get('blacklist/add','AdminController@AddBlackList')->name('AddBlackList');
    Route::get('product/view','AdminController@ProductView')->name('ProductView');
    Route::get('shop/view', 'AdminController@ShopView')->name('ShopView');
    Route::get('add/category','AdminController@CategoryAdd')->name('CategoryAdd');
    Route::get('author/add','AdminController@AuthorAdd')->name('AuthorAdd');
    Route::get('message/page','AdminController@MessagePage')->name('MessagePage');
    Route::get('message/answer','AdminController@MessageAnswer')->name('MessageAnswer');


});





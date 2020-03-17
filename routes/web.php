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
Route::get('addProduct/', 'UserController@AddProduct')->name('AddProduct');
Route::get('show/cart' , 'UserController@CartPage')->name('CartPage');
Route::get('del/', 'UserController@DeleteProduct')->name('DeleteProduct');
Route::get('delete/all','UserController@DeleteAll')->name('DeleteAll');
Route::get('search/form', 'UserController@SearchForm')->name('SearchForm');
Route::get('order/form','UserController@OrderForm')->name('OrderForm');
Route::get('order/create','UserController@OrderCreate')->name('OrderCreate');
Route::get('article/{articleId}','UserController@Article')->name('Article');
Route::get('category/{categoryId}','UserController@ArticleCategory')->name('ArticleCategory');
Route::get('test','UserController@Test')->name('Test');
Route::get('popular','UserController@Popular')->name('Popular');
Route::get('fresh','UserController@FreshArticles')->name('FreshArticles');
Route::get('search','UserController@Search')->name('Search');

Route::get('search/product','UserController@SearchProduct')->name('SearchProduct');

//Admin
Route::get('admin','AdminController@LoginPage')->name('admin.LoginPage');
Route::post('admin/login','AdminController@Login')->name('admin.Login');

Route::group(['prefix' => 'admin', 'middleware' => 'adminCheck', 'name' => 'check'], function(){

});

Route::name('admin.')->prefix('admin')->middleware(['adminCheck'])->group(function () {
    Route::get('articles/view/{id?}','AdminController@ViewPost')->name('ViewPost');
    Route::get('articles/delete/{id?}','AdminController@DeletePost')->name('DeletePost');
    Route::get('articles/edit/{id?}','AdminController@EditArticle')->name('EditArticle');
    Route::get('users','AdminController@Users')->name('Users');
    Route::get('out','AdminController@Out')->name('Out');
    Route::post('RegisterUser','AdminController@RegisterUser')->name('RegisterUser');
    Route::get('tree/{userId?}','AdminController@Tree')->name('Tree');
    Route::get('RejectUser/{userId}','AdminController@RejectUser')->name('RejectUser');


    Route::get('product/view','AdminController@ProductView')->name('ProductView');
    Route::get('shop/view', 'AdminController@ShopView')->name('ShopView');
    Route::get('add/category','AdminController@CategoryAdd')->name('CategoryAdd');
    Route::get('add/category','AdminController@PostCatAdd')->name('PostCatAdd');
    Route::get('author/add','AdminController@AuthorAdd')->name('AuthorAdd');
    Route::get('message/page','AdminController@MessagePage')->name('MessagePage');
    Route::get('create/post','AdminController@CreatePost')->name('CreatePost');
    Route::get('message/answer','AdminController@MessageAnswer')->name('MessageAnswer');
    Route::get('withdraws', 'AdminController@WithdrawShow')->name('WithdrawShow');
    Route::get('withdraw/allow/{withdrawId?}' , 'AdminController@WithdrawAllow')->name('WithdrawAllow');
    Route::get('orders','AdminController@Orders')->name('Orders');
    Route::get('orders/view/{id?}','AdminController@OrdersView')->name('OrdersView');
    Route::get('withdraw/reject/{withdrawId?}', 'AdminController@WithdrawReject')->name('WithdrawReject');
    Route::post('create/product','AdminController@CreateProduct')->name('CreateProduct');
    Route::get('store/article','AdminController@Store')->name('Store');
    Route::post('upload','AdminController@upload')->name('upload');


    Route::get('article/view','AdminController@Posts')->name('Posts');

    Route::post('edit/post','AdminController@EditPost')->name('EditPost');
    Route::post('article/store','AdminController@StoreArticle')->name('StoreArticle');


});






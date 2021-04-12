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

Route::get('/', function () {
    return redirect('/');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/logout', function () {
	Session::flush();
    Auth::logout();
    return redirect('/login');
});

Route::group(['middleware' => ['auth']], function() {

	Route::get('/', 'HomeController@index');

	Route::get('/taonhom', 'HomeController@getAddGroup');

	Route::get('/danhsachnguoidung','NguoiDungController@index');
	Route::get('/deletenguoidung/{id}','NguoiDungController@delete');
	Route::get('/signup','NguoiDungController@getSignup')->name('user.signup');
	Route::post('/signup','NguoiDungController@postSignup')->name('user.signup');
	Route::get('/editnguoidung/{id}','NguoiDungController@getEdit');
	Route::post('editnguoidung/{id}','NguoiDungController@postEdit');

	Route::get('/danhsachchucvu','ChucVuController@index');
	Route::get('/deletechucvu/{id}','ChucVuController@delete');

	Route::get('/addchucvu','ChucVuController@getAdd');
	Route::post('addchucvu','ChucVuController@postAdd');

	Route::get('/editchucvu/{id}','ChucVuController@getEdit');
	Route::post('editchucvu/{id}','ChucVuController@postEdit');


    ///
	Route::get('/taonhom', 'HomeController@getAddGroup')->middleware(['permission:add-group']);
	Route::post('/taonhom', 'HomeController@getPostGroup')->middleware(['permission:add-group']);

	Route::get('/group/{id}', 'HomeController@getGroup');
    Route::get('/addthanhvien/{id}','GroupController@addMember');
    Route::post('/addthanhvien/{id}','GroupController@postMember');

    Route::get('/addpost/{id}','PostController@getAdd');
    Route::post('/addpost/{id}','PostController@postAdd');

    Route::get('/pheduyet/group/{id}','PostController@pheduyet');
    Route::get('/pheduyet/{id}','PostController@getDuyet');
    Route::post('/pheduyet/{id}','PostController@postDuyet');

    Route::get('/post/{id}','PostController@getPost');
    Route::get('/post/delete/{id}','PostController@delete');
});



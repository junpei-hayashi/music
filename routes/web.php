<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\My_pageController;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//↓管理者ページ
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');

Route::view('/home', 'user.home')->middleware('auth');
Route::view('/admin', 'admin.admin');

// 一般ユーザーマイページ
    // ↓home.bladeからgeneral_mypage.bladeのMy_pagecontrollerへ遷移
    Route::resource('id', 'My_pageController');
    
    Route::get('/my_page2', 'My_pageController@index');
    Route::post('/my_page2', 'My_pageController@my_page_update');



// Route::get('/user.general_mypage/{id}',[My_pageController::class, 'userMypage'])->name('mypage.user');
// Route::group(['middleware' => 'can:view,home'], functnoion(){
//     // ↓ホーム&エラーハンドリング：ルートモデルバインディング
//     Route::get('/spend/{spending}/detail',[DisplayController::class,'spendDetail'])->name('spend.detail');

// });
<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\My_pageController;
use App\Http\Controllers\MusicController;

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

Route::group(['middleware' => ['auth']], function(){


    // 管理者マイページ
    // ↓home.bladeからgeneral_mypage.bladeのMy_pagecontrollerへ遷移
    Route::resource('id', 'Admin_My_pageController');

    // 一般ユーザーマイページ
    // ↓home.bladeからgeneral_mypage.bladeのMy_pagecontrollerへ遷移
    Route::resource('id', 'My_pageController');
    // ↓マイページの編集
    Route::post('/general_edit',[My_pageController::class, 'editGeneral'])->name('edit.general');

    Route::get('/my_page2', 'My_pageController@index');
    Route::post('/my_page2', 'My_pageController@my_page_update');


    // 一般ユーザーからアーティストへ
    Route::get('/artist.artist_up/{id}',[My_pageController::class, 'artist_update'])->name('artist.up');
    // ↓アーティスト登録画面
    Route::get('/create_artist',[RegistrationController::class, 'createArtistForm'])->name('create.artist');
    Route::post('/create_artist',[RegistrationController::class, 'createArtist']);

    // 投稿用のページ:投稿用のルート
    Route::group(['prefix' => 'post'],function(){
        Route::get('/post_music',[MusicController::class, 'postMusic'])->name('post.music');
        Route::post('/post_music',[MusicController::class, 'postComplite'])->name('post.complite');
    });
});



// Route::get('/user.general_mypage/{id}',[My_pageController::class, 'userMypage'])->name('mypage.user');
// Route::group(['middleware' => 'can:view,home'], functnoion(){
//     // ↓ホーム&エラーハンドリング：ルートモデルバインディング
//     Route::get('/spend/{spending}/detail',[DisplayController::class,'spendDetail'])->name('spend.detail');

// });
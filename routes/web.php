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


Route::group(['middleware' => ['auth']], function(){
    
    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/home/search', 'HomeController@index')->name('search.musics');
    
    //↓管理者ページ
    Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
    Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
    
    Route::post('/login/admin', 'Auth\LoginController@adminLogin');
    Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
    
    // Route::view('/home', 'user.home')->middleware('auth');
    Route::view('/admin', 'admin.admin');//ここ気をつけて


    // 管理者マイページ
    // ↓home.bladeからgeneral_mypage.bladeのMy_pagecontrollerへ遷移
    Route::resource('id', 'Admin_My_pageController');

    // ユーザー専用のルーティング
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



    // アーティスト専用のルーティング
        // アーティストマイページ
        Route::get('/artist_mypage/{id}',[DisplayController::class, 'artistMypage'])->name('artist.mypage');
        // アーティストマイページ編集画面へ
        Route::get('/artist_edit/{id}',[DisplayController::class, 'artistEdit'])->name('artist.edit');
        // アーティストマイページ編集
        Route::post('/artist_edit/{id}',[My_pageController::class, 'editArtist'])->name('edit.artist');
        // 投稿曲一覧画面のルーティング
        Route::get('/postmusic_list/{id}',[DisplayController::class, 'musicList'])->name('music.list');
        // 投稿用のページ:投稿用のルート
        Route::group(['prefix' => 'post'],function(){
            Route::get('/post_music',[MusicController::class, 'postMusic'])->name('post.music');
            Route::post('/post_music',[MusicController::class, 'postComplite'])->name('post.complite');
            
        });
        // 曲の編集画面
        Route::get('/music_edit/{id}',[MusicController::class, 'editMusic'])->name('edit.music');
        Route::post('/music',[MusicController::class, 'editMusicComplite'])->name('edit.compmusic');
        // 曲の削除
        Route::get('/delete_musict/{id}',[MusicController::class, 'deleteMusic'])->name('delete.music');
    
    
    // 共通のルーティング
        //アーティスト詳細ページ
        Route::get('/artist_detail/{id}',[DisplayController::class, 'artistDetail'])->name('artist.detail');
        //曲の視聴ページ
        Route::get('/music_detail/{id}',[MusicController::class, 'musicDetail'])->name('music.detail');
        // いいね機能のルーティング
        Route::post('/like', 'RegistrationController@like')->name('musics.like');

        //フォロー機能のルーティング
        Route::post('/follow', 'RegistrationController@follow')->name('artists.follow');
        //いいね表示のルーティング
        Route::get('/like_musiclist/{id}',[MusicController::class, 'likeList'])->name('like.musiclist');
});



// Route::get('/user.general_mypage/{id}',[My_pageController::class, 'userMypage'])->name('mypage.user');
// Route::group(['middleware' => 'can:view,home'], functnoion(){
//     // ↓ホーム&エラーハンドリング：ルートモデルバインディング
//     Route::get('/spend/{spending}/detail',[DisplayController::class,'spendDetail'])->name('spend.detail');

// });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

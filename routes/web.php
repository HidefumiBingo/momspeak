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


Route::get('/','PostsController@index')->name('posts.index');  

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

//認証付ルーティング
Route::group(['middleware' => ['auth']], function() {
    Route::group(['prefix' => 'users/{id}'], function() {
        Route::post('follow','UserFollowController@store')->name('user.follow');
        Route::delete('unfollow','UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings','UsersController@followings')->name('users.followings');
        Route::get('followers','UsersController@followers')->name('users.followers');
        Route::get('userslist','UsersController@userslist')->name('users.userslist');
        Route::get('favorites','UsersController@favorites')->name('users.favorites');
        //messageの保存用ルート
        Route::post('messages','MessagesController@store')->name('messages.store');
    });
    Route::resource('users','UsersController',['only' => ['index','show','edit','update']]);


    Route::group(['prefix' => 'posts/{id}'], function() {
       Route::post('favorite','FavoritesController@store')->name('favorites.favorite');
       Route::delete('unfavorite','FavoritesController@destroy')->name('favorites.unfavorite');
       //commentの保存用ルート
       Route::post('comment','CommentsController@store')->name('comments.comment');
    });
    Route::resource('posts','PostsController',['only' => ['show','store','edit','update','destroy']]);
    

    Route::resource('comments','CommentsController',['only' => ['edit','update','destroy']]);
    
    
    Route::resource('messages','MessagesController',['only' => ['show','destroy']]);
    
    Route::post('contacts','ContactsController@store')->name('contacts.store');
    

});


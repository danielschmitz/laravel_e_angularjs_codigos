<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
        return Redirect::to('/index.html');
});

Route::get('/posts/last/{n?}', 'PostController@last');
Route::get('/menuinfo', 'BlogController@getMenuInfo');
Route::get('/users/posts', 'UserController@getAllposts');
Route::get('/comments', 'CommentController@getAll');
Route::get('/tags/posts', 'TagController@getAllWithPosts');

Route::post('/login','UserController@doLogin');
Route::get('/login','UserController@getLogin');
Route::get('/logout','UserController@doLogout');

Route::post('/user/newlogin','UserController@createLogin');

//Rotas para TagResource
Route::get('/tags', 'TagController@index');
Route::get('/tags/{id}', 'TagController@show');
Route::post('/tags', ['middleware'=>'auth','uses'=>'TagController@save']);

//Rotas para PostResource
Route::get('/posts', 'PostController@index');
Route::get('/posts/getTitles', 'PostController@getTitles');
Route::get('/posts/{id}', 'PostController@show');
Route::post('/posts', ['middleware'=>'auth','uses'=>'PostController@save']);


//Rotas para comments
Route::get('/comments/post/{id}', 'CommentController@getCommentsByPost');
Route::post('/comments', ['middleware'=>'auth','uses'=>'CommentController@save']);

//Rotas para UserResource
Route::get('/users', 'UserController@index');
Route::get('/users/{id}', 'UserController@show');
Route::post('/users', ['middleware'=>'auth','uses'=>'UserController@saveFromRequest']);


Route::get('routes', function() {
     \Artisan::call('route:list');
     return "<pre>".\Artisan::output();
});

//Display all SQL executed in Eloquent
// in a storage/logs/sql.log file
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
\DB::listen(function($sql, $bindings, $time) {

    if (App::environment()=="local"){
        $xsql = explode("?", $sql);
        $nsql = "";
        for ($i=0; $i < count($xsql)-1; $i++) { 
            $nsql .= $xsql[$i] . $bindings[$i];
        }
        $view_log = new Logger("SQL");
        $view_log->pushHandler(
            new StreamHandler('./../storage/logs/sql.log')
            );
        $view_log->addInfo($nsql?:$sql);
    }
});
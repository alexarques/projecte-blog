<?php

use App\Http\Controllers\IndexController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

/*Route::get('/', function () {
    return view('welcome');
});*/


//Rutes principals


Route::get('/',[IndexController::class,'index'])->name('index');


Route::middleware(['auth','role:admin'])->prefix('admin')->group(function(){
    Route::get('/',function(){
        return "admin.......users.";

    })->name('admin.users');

    //administración, backend users, backend posts
    //Route::get()----

});
//Route::view('/','home',['posts'=>['title'=>'Hola','contents'=>'Lorem']]);
/*Route::get('posts/{post?}',function(Post $post){
    if($post==null){
        return Post::all();
    }
    $post=Post::findOrFail($post);
    return $post;

})->where('post','[0-9]+');*/
/*->middleware(['auth'])*/;

//Route::resource('post');

Route::get('/', function (User $user) {
    return $user;
});

Route::get('comments/{comment?}', function (Comment $comment) {
    return $comment;
});

Route::get('posts/{post?}',function(Post $post){
    return $post;

});
/*->middleware(['auth'])*/;

Route::get('/','HomeController@index')->name('home');
Route::get('/store', 'PostController@store')->name('posts.store');
Route::get('/edit/{post}', 'PostController@edit')->name('posts.edit');
// Route::get('/update/{post}', 'PostController@update')->name('posts.update');
Route::delete('/destroy/{post}', 'PostController@destroy')->name('posts.destroy');
Route::get('/comment', 'PostController@commstore')->name('posts.commstore');

Auth::routes();




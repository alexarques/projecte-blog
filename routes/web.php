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
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile/update/{user}', 'ProfileController@update')->name('profile.update');
Route::get('/control_panel', 'ControlPanelController@index')->name('control_panel');
Route::put('/control_panel/update/{user}', 'ControlPanelController@update')->name('control_panel.update');
Route::delete('/control_panel/destroy/{post}', 'ControlPanelController@destroy')->name('control_panel.destroy');

Route::post('/post_store', 'PostController@store')->name('posts.store');
Route::get('posts/edit/{post}', 'PostController@edit')->name('posts.edit');
Route::put('posts/update/{post}', 'PostController@update')->name('posts.update');
Route::delete('/destroy/{post}', 'PostController@destroy')->name('posts.destroy');
Route::post('/comment_store/{post}', 'CommentController@store')->name('comments.store');
Route::delete('/destroy/{comment}', 'CommentController@destroy')->name('comments.destroy');
Route::post('/tags', 'TagController@store')->name('tags.store');
Route::delete('/destroy/{tag}', 'TagController@destroy')->name('tags.destroy');


// RUTA QUE MUESTRA LOS PRIMEROS REGISTROS
Route::get('nombres', 'SearchController@index');
// RUTA PARA SCROLL INFINITO DINÁMICO
Route::get('posts/search', 'PostController@search')->name('posts.search');
// RUTA PARA EL BUSCADOR EN TIEMPO REAL
Route::get('posts/searching','PostController@searching')->name('posts.searching');

Auth::routes();




<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\postsController;

use App\Http\Controllers\UserController;


// Route::get('/home',[postsController::class,'getAllPosts'])
// ->name('posts.show');

// Route::get('/home/update',[postsController::class,'getAllPosts'])
// ->name('posts.update');

// Route::post('/posts',[postsController::class,'addPost'])
// ->name('posts.store');

// Route::get('/posts/{id}', [postsController::class,'getPostByID'])
// ->name('posts.get')
// ->where('id', '[0-9]+');

// Route::get('/posts/delete/{id}', [postsController::class,'deletePost'])
// ->name('posts.delete')
// ->where('id', '[0-9]+');


// Route::get('/create/post',[postsController::class ,'createPost'])
// ->name('posts.create');


// Route::get('/posts', [postsController::class,'details'])
// ->name('posts.details');



// Route::get('/posts/edit/{id}', [postsController::class,'editPost'])
// ->name('posts.edit')
// ->where('id', '[0-9]+');




// If you don't need all the routes, you can specify only certain ones:


// Route::resource('posts', PostsController::class)->except([
//     'create', 'edit'
// ]);


// Or exclude certain routes:
// Route::resource('posts', PostsController::class)->only([
//     'index', 'show'
// ]);


Route::get('/posts/details', [PostsController::class, 'showDetails'])
    ->name('posts.details');
    Route::get('/posts/main', [PostsController::class, 'main'])
    ->name('posts.main');

    Route::get('/posts/restore/{post}', [PostsController::class, 'restore'])
    ->name('posts.restore');
Route::resource('posts', PostsController::class);

Route::resource('users', UserController::class);




// GET|HEAD        / ....................................................
// GET|HEAD        posts ........................... posts.index › postsController@index
// POST            posts .......................................... posts.store › postsController@store
// GET|HEAD        posts/create ...................................... posts.create › postsController@create
// GET|HEAD        posts/{post} ........................................... posts.show › postsController@show
// PUT|PATCH       posts/{post} ............................................................. posts.update › postsController@update
// DELETE          posts/{post} ................................................. posts.destroy › postsController@destroy
// GET|HEAD        posts/{post}/edit .................................................. posts.edit › postsController@edit
// GET|HEAD        up ............................................................................................................................................................

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



use Laravel\Socialite\Facades\Socialite;

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('github.login');


Route::get('/auth/callback', [\App\Http\Controllers\Api\userController::class, 'createUserGit']);

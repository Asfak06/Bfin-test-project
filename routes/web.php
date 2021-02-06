<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
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

// Route::get('/test',function(){
//   $code=bcrypt('shovon12');

// if(Hash::check('','$2y$10$8dHh93Z/KJ7Vb8xuFT8e7Ovblpv6oATukf.dTVG2FPznDKgbImYKq')) {
//      echo 'true';
// } else {
//     echo 'false';
// }
// });

Route::get('/',[
    'uses' => 'HomeController@index',
    'as' => 'stories'
]);
Route::get('section/{id}', [
    'uses' => 'HomeController@section',
    'as' => 'section'
]);
Route::get('tag/{id}', [
    'uses' => 'HomeController@tag',
    'as' => 'tag'
]);
Route::get('/search', [
    'uses' => 'HomeController@search',
    'as' => 'search'
]);
Route::get('story/me', [
'uses' => 'HomeController@mystory',
'as' => 'story.me'
]);
Route::get('story/restore/{story}', [
'uses' => 'HomeController@restore',
'as' => 'story.restore'
])->middleware('admin');
Route::get('story/unlist/{story}', [
'uses' => 'HomeController@unlist',
'as' => 'story.unlist'
])->middleware('admin');
Route::get('story/unlisted', [
'uses' => 'HomeController@unlisted',
'as' => 'story.unlisted'
])->middleware('admin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('users', function(){
  $users=User::all();
  return view('users.list')->with('user',$users);
})->middleware('admin')->name('users');


Route::get('profile/edit', [
'uses' => 'ProfileController@edit',
'as' => 'profile.edit'
])->middleware(['auth']);

Route::post('profile/update', [
'uses' => 'ProfileController@update',
'as' => 'profile.update'
])->middleware(['auth']);

Route::get('/admin', [
'uses' => 'ProfileController@adminadd',
'as' => 'admin'
])->middleware(['admin']);

Route::post('admin/create', [
'uses' => 'ProfileController@admin',
'as' => 'admin.create'
])->middleware(['admin']);

Route::get('admin/remove/{id}', [
'uses' => 'ProfileController@adminremove',
'as' => 'admin.remove'
])->middleware(['admin']);

Route::resource('stories', 'StoryController');

Route::middleware(['auth','unblocked'])->group(function () {
   Route::resource('sections', 'SectionsController');
   Route::resource('tags', 'TagsController');
   Route::resource('stories/{story}/comments', 'CommentsController');

   Route::get('profile/block/{id}', [
    'uses' => 'ProfileController@block',
    'as' => 'profile.block'
   ])->middleware('admin');
   Route::get('profile/unblock/{id}', [
    'uses' => 'ProfileController@unblock',
    'as' => 'profile.unblock'
   ])->middleware('admin');

});

require __DIR__.'/auth.php';


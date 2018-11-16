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

Route::get('/','HomeController@index')->name('home');

Auth::routes();
/*user profile*/
Route::get('profile/{username}','AuthorController@profile')->name('author.profile');


/*subscriber*/
Route::post('subscriber','SubscriberController@store')->name('subscriber.store');

/*post route*/
Route::get('post/{slug}','PostController@details')->name('post.details');
Route::get('posts','PostController@index')->name('posts.index');
/*category whit post*/
Route::get('/category/{slug}','PostController@postbycategory')->name('category.posts');

/*tag whit post*/
Route::get('/tag/{slug}','PostController@postbytag')->name('tag.posts');

/*search ar jonno*/
Route::get('/search','SearchController@search')->name('search');

/*favorite post route*/
Route::group(['middleware'=>['auth']], function(){   
   Route::post('favorite/{post}/add','FavoriteControler@add')->name('post.favorite');
   Route::post('comment/{post}','CommentController@store')->name('comment.store');
	});

/*--------------------------------that is for Admin---------------------------------------------------------------------------------------------------------------------------------------------------------*/
Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function(){
  
  Route::get('dashbord','DashbordController@index')->name('dashbord');
  Route::resource('tag','TagController');
  Route::resource('category','CategoryController');
  Route::resource('post','PostController');

  Route::put('/post/{id}/approve','PostController@approve')->name('post.approve');
  Route::get('/pending/post','PostController@panding')->name('post.panding');
  Route::get('/subscriber','SubscriberController@index')->name('subscriber.index');
    Route::delete('/subscriber/{subscriber}','SubscriberController@destroy')->name('subscriber.destroy');
    /*setting conmtroller*/
    Route::get('setting','SettingsController@index')->name('setting.index');
    Route::put('profile-update','SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingsController@updatePassworde')->name('password.update');
    /*favorite post show*/
    Route::get('favorite','FavoriteController@index')->name('favorite.index');

    /*comment */
    Route::get('comments','CommentController@index')->name('comment.index');
    Route::delete('comments/{id}','CommentController@destroy')->name('comment.destroy');


/*author show controller*/
Route::get('authors','AuthorController@index')->name('author.index');
Route::delete('author/{id}','AuthorController@destroy')->name('author.destroy');

});
/*--------------------------------that is for Author---------------------------------------------------------------------------------------------------------------------------------------------------------*/
Route::group(['as'=>'author.','prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author']], function(){
	
	Route::get('dashbord','DashbordController@index')->name('dashbord');
	Route::resource('post','PostController');
	/*setting conmtroller*/
    Route::get('setting','SettingsController@index')->name('setting.index');
    Route::put('profile-update','SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingsController@updatePassworde')->name('password.update');
     /*favorite post show*/
    Route::get('favorite','FavoriteController@index')->name('favorite.index');
    
    /*comment */
    Route::get('comments','CommentController@index')->name('comment.index');
    Route::delete('comments/{id}','CommentController@destroy')->name('comment.destroy');
});

/*that is verey powerfull route .jakaono jagai accsess kora jai controller charai*/
View::composer('layouts.fontend.partial.fotter',function ($view){
      
      $cartegory=App\category::all();
      $view->with('cartegory',$cartegory);

});
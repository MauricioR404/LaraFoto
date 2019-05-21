<?php
/**
use App\Image;

Route::get('/', function () {

	$images = Image::all();

	foreach($images as $image)
	{
		echo "<pre>";
		echo $image->user_id. "<br>";
		echo $image->image_path. "<br>";
		echo $image->description. "<br>";
		echo $image->user->name . "<br>";
		echo "</pre>";
	}

	die();

    return view('welcome');
});

*/

//Rutas de mi aplicacion

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//Usuario
Route::get('/configuracion', 'UserController@config')->name('config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/perfil/{id}', 'UserController@profile')->name('profile');
Route::get('/gente/{search?}', 'UserController@index')->name('user.index');

//Imagen
Route::get('/subir-imagen', 'ImageController@create')->name('image.create');
Route::post('/imagen/save', 'ImageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/imagen/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('/imagen/editar/{id}', 'ImageController@edit')->name('image.edit');
Route::post('/imagen/update', 'ImageController@update')->name('image.update');

//Comentarios
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::post('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');

//Likes
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');





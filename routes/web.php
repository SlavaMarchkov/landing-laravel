<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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

Route::group( [ 'middleware' => 'web' ], function () {
	Route::match( [ 'get', 'post' ], '/', [ IndexController::class, 'execute' ] )->name( 'home' );
	Route::get( '/page/{alias}', [ PageController::class, 'execute' ] )->name('page');
//	Auth::routes(); // Route::auth();
} );

/*Route::group(
	[
		'prefix' => 'admin',
		'middleware' => 'auth'
	],
	function() {

	// admin
	Route::get('/', function() {

	});

	// admin/pages
	Route::group(['prefix' => 'pages'], function() {
		// admin/pages
		Route::get(
			'/',
			[
				'uses' => 'PagesController@execute',
				'as' => 'pages'
			]
		);
		// admin/pages/add
		Route::match(
			['get', 'post'],
			'/add',
			[
				'uses' => 'PagesAddController@execute',
				'as' => 'pagesAdd'
			]
		);
		// admin/edit/2
		Route::match(
			['get', 'post', 'delete'],
			'/edit/{page}',
			[
				'uses' => 'PagesEditController@execute',
				'as' => 'pagesEdit'
			]
		);
	});
}
);*/
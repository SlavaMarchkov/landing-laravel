<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PagesAddController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PagesEditController;
use App\Http\Controllers\PortfoliosAddController;
use App\Http\Controllers\PortfoliosController;
use App\Http\Controllers\PortfoliosEditController;
use App\Http\Controllers\ServicesAddController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ServicesEditController;
use Illuminate\Support\Facades\Auth;
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
	Route::get( '/page/{alias}', [ PageController::class, 'execute' ] )->name( 'page' );
	Auth::routes();
} );

Route::group( [ 'prefix' => 'admin', 'middleware' => 'auth' ], function () {
	// main admin page /admin
	Route::get( '/', function () {
		if ( view()->exists( 'admin.index' ) ) {
			$data = [ 'title' => 'Панель администратора' ];

			return view( 'admin.index', $data );
		}

		return FALSE;
	} );

	// admin/pages
	Route::group( [ 'prefix' => 'pages' ], function () {
		Route::get( '/', [ PagesController::class, 'execute' ] )->name( 'pages' ); // admin/pages
		Route::match( [ 'get', 'post' ], '/add', [ PagesAddController::class, 'execute' ] )->name( 'pagesAdd' ); // admin/pages/add
		Route::match( [ 'get', 'post', 'delete' ], '/edit/{page}', [ PagesEditController::class, 'execute' ] )->name( 'pagesEdit' ); // admin/edit/2
	} );

	Route::group( [ 'prefix' => 'portfolios' ], function () {
		Route::get( '/', [ PortfoliosController::class, 'execute' ] )->name( 'portfolios' );
		Route::match( [ 'get', 'post' ], '/add', [ PortfoliosAddController::class, 'execute' ] )->name( 'portfoliosAdd' );
		Route::match( [ 'get', 'post', 'delete' ], '/edit/{portfolio}', [ PortfoliosEditController::class, 'execute' ] )->name( 'portfoliosEdit' );
	} );

	Route::group( [ 'prefix' => 'services' ], function () {
		Route::get( '/', [ ServicesController::class, 'execute' ] )->name( 'services' );
		Route::match( [ 'get', 'post' ], '/add', [ ServicesAddController::class, 'execute' ] )->name( 'servicesAdd' );
		Route::match( [ 'get', 'post', 'delete' ], '/edit/{portfolio}', [ ServicesEditController::class, 'execute' ] )->name( 'servicesEdit' );
	} );
} );

Route::get( '/home', [ App\Http\Controllers\HomeController::class, 'index' ] )->name( 'home' );

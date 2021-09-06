<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{

	public function execute( $alias )
	{
		// если запрос пуст, то выдаем страницу 404
		if ( ! $alias ) {
			abort( 404 );
		}

		// если запрос не пуст, то проверяем, есть ли вид и показываем его, передавая данные из БД
		if ( view()->exists( 'site.page' ) ) {
			$page = Page::where( 'alias', strip_tags( $alias ) )->first();
			$data = [
				'title' => $page->name,
				'page'  => $page
			];

			return view( 'site.page', $data );
		} else {
			abort( 404 );
		}

		return FALSE;
	}

}

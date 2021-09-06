<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PagesController extends Controller
{

	public function execute()
	{
		if ( view()->exists( 'admin.pages' ) ) {
			$pages = Page::all();
			$data  = [
				'title' => 'Страницы',
				'pages' => $pages
			];

			return view( 'admin.pages', $data );
		} else {
			abort( 404 );
		}

		return FALSE;
	}

}

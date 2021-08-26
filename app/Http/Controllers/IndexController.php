<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Page;
use App\Models\People;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

	public function execute( Request $request )
	{
		$pages = Page::all();
		$portfolios = Portfolio::get(['name', 'filter', 'images']);
		$services = Service::where('id', '<', '20')->get();
		$clients = Client::where('id', '<>', '4')->get();
		$people = People::take(3)->get();

		$tags = DB::table('portfolios')->distinct()->get(['filter']);

		$menu = [];
		foreach ($pages as $page) {
			$item = [
				'title' => $page->name,
				'alias' => $page->alias,
			];
			array_push($menu, $item);
		}

		return view('site.index', [
			'menu' => $menu,
			'pages' => $pages,
			'portfolios' => $portfolios,
			'services' => $services,
			'people' => $people,
			'clients' => $clients,
			'tags' => $tags,
		]);
	}

}

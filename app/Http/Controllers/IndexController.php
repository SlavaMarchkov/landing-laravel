<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\People;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;

class IndexController extends Controller
{

	public function execute( Request $request )
	{
		$pages = Page::all();
		$portfolios = Portfolio::get(array('name', 'filter', 'images'));
		$services = Service::where('id', '<', '20')->get();
		$people = People::take(3)->get();

//		dd($pages);

		return view('site.index');
	}

}

<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Page;
use App\Models\People;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class IndexController extends Controller
{

	/**
	 * Главный обработчик запросов с главной страницы сайта home
	 *
	 * @param Request $request - объект запроса
	 *
	 * @return Factory|View
	 * @throws ValidationException
	 */
	public function execute( Request $request )
	{
		// обработка POST-запроса
		$messages = [
			'required' => 'Поле :attribute обязательно к заполнению',
			'email' => 'Поле :attribute должно соответствовать формату email-адреса',
		];
		if ($request->isMethod('post')) {
			$this->validate($request, [
				'name' => 'required|max:255',
				'email' => 'required|email',
				'text' => 'required'
			], $messages);
			$data = $request->all();

			// отправляем email
			Mail::send('site.mail', ['data' => $data], function ($message) use ($data) {
				$mail_admin = env('MAIL_ADMIN');
				$message->from($data['email'], $data['name']);
				$message->to($mail_admin, 'Mr. Admin')->subject('Запрос из формы обратной связи на сайте');
			});
			return redirect()->route('home')->with('status', 'Email was sent successfully');
		}

		// обработка GET-запроса
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

<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesAddController extends Controller
{

	public function execute( Request $request )
	{
		// POST-запрос
		if ( $request->isMethod( 'post' ) ) {
			$input     = $request->except( '_token' );
			$messages = [
				'required' => 'Поле :attribute обязательно к заполнению',
				'unique' => 'Поле :attribute должно иметь уникальное название'
			];
			$validator = Validator::make( $input, [
				'name'  => 'required|max:100',
				'alias' => 'required|unique:pages|max:100',
				'title' => 'required|max:255',
			], $messages );
			if ( $validator->fails() ) { // если есть ошибки валидации, то выводим их на экран на той же самой странице
				return redirect()->route( 'pagesAdd' )->withErrors( $validator )->withInput();
			}
			if ( $request->hasFile( 'images' ) ) {
				$file            = $request->file( 'images' );
				$input['images'] = $file->getClientOriginalName();
				$file->move( public_path() . '/assets/img/', $input['images'] );
			}
			// записываем инфо в БД
			$page = new Page();
//			$page->unguard();
			$page->fill( $input );
			if ( $page->save() ) {
				return redirect( 'admin/pages' )->with( 'admin_status', 'Страница успешно добавлена' );
			}
		}

		// GET-запрос
		if ( view()->exists( 'admin.pages_add' ) ) {
			$data = [
				'title' => 'Новая страница'
			];

			return view( 'admin.pages_add', $data );
		} else {
			abort( 404 );
		}

		return FALSE;
	}

}

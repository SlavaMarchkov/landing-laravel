<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesEditController extends Controller
{

	public function execute( Page $page, Request $request )
	{
		// POST-запрос на удаление
		if ( $request->isMethod( 'delete' ) ) {
			$page->delete();

			return redirect( 'admin/pages' )->with( 'admin_status', 'Страница удалена' );
		}

		// POST-запрос на обновление
		if ( $request->isMethod( 'post' ) ) {
			$input     = $request->except( '_token' );
			$validator = Validator::make( $input, [
				'name'  => 'required|max:100',
				'alias' => 'required|unique:pages,alias,' . $input['id'] . '|max:100',
				'title' => 'required|max:255',
			] );
			if ( $validator->fails() ) {
				return redirect()->route( 'pagesEdit', [ 'page' => $input['id'] ] )->withErrors( $validator );
			}
			if ( $request->hasFile( 'images' ) ) {
				$file = $request->file( 'images' );
				$file->move( public_path() . '/assets/img', $file->getClientOriginalName() );
				$input['images'] = $file->getClientOriginalName();
			} else {
				$input['images'] = $input['old_images'];
			}
			unset( $input['old_images'] );
			$page->fill( $input );
			if ( $page->update() ) {
				return redirect( 'admin/pages' )->with( 'admin_status', 'Страница успешно обновлена!' );
			}
		}

		// GET-запрос
		$old = $page->toArray();
		if ( view()->exists( 'admin.pages_edit' ) ) {
			$data = [
				'title' => 'Редактирование страницы - ' . $old['name'],
				'data'  => $old
			];

			return view( 'admin.pages_edit', $data );
		} else {
			abort( 404 );
		}

		return FALSE;
	}

}

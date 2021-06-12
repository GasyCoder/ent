<?php

class PagesController extends BaseController {

/*-------------- pages -------------------*/

	protected $page_rules = [

			'name'=>'required|max:25',
			'content'=>'required'

	];



	protected function make_slug($string = null, $separator = "-") {
	    if (is_null($string)) {
	        return "";
	    }

	    $string = trim($string);
	    $string = mb_strtolower($string, "UTF-8");;
	    $string = preg_replace("/[^a-z0-9_\s-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", "", $string);
	    $string = preg_replace("/[\s-]+/", " ", $string);
	    $string = preg_replace("/[\s_]/", $separator, $string);

	    return $string;
	}



	public function index()
	{	
		$pages = Page::orderBy('id', 'desc')->paginate(15);

		return View::make('admin.pages', compact('pages'));
	}



	public function page_create()
	{	
		return View::make('admin.new_page');
	}



	public function page_store()
	{	
			$inputs = Input::all();

			$validation = Validator::make($inputs, $this->page_rules);

			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);
			} 

			else {
		
					$page = Page::create([

					'name'=>e($inputs['name']),
					'slug'=>$this->make_slug($inputs['name']),
					'content'=>e($inputs['content'])
					
					]);

				$page->save();

				$path = Session::get('language');
				return Redirect::back()->with('success', Lang::get($path.'.success_added'));

			}
	}


	public function page_edit($id)
	{
		$page = Page::find($id);

		if ($page !== null) {
			return View::make('admin.update_page', compact('page'));
		} else {
			return Redirect::back('admin_pages');
		}

	}


	public function page_update($id)
	{	
		$page = Page::find($id);

		if ($page !== null) {
			
			$inputs = Input::all();

			$validation = Validator::make($inputs, $this->page_rules);

			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);
			} 

			else {

				$page->name = e($inputs['name']);
				$page->slug = $this->make_slug($inputs['name']);
				$page->content = e($inputs['content']);
				$page->save();

				$path = Session::get('language');
				return Redirect::back()->withSuccess(Lang::get($path.'.Modified_successfully'));

			}


		} else {
			return Redirect::back('admin_pages');
		}
	}

	public function page_destroy($id)
	{	
		$page = Page::find($id);
		$page->delete();

		$path = Session::get('language');
		return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));
	}

}
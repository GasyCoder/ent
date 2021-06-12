<?php

class LibraryController extends BaseController {


	protected $rules = [

			'file_name'=>'required|min:2',
			'file'=>'required|max:5120|mimes:doc,docx,ppt,pptx,pdf,rar,zip'

	];

	public function index()
	{	
		$user = User::find(Auth::user()->id);
		$control = Control::find(1);
		$library_apv = $control->library_apv;
		$library_files = Library::orderBy('id', 'desc')->paginate(15);

		$categories = TheCategoryLibrary::orderBy('id', 'desc')->get();

		return View::make('users.library', compact('library_files', 'user', 'library_apv', 'categories'));
	}


	public function category()
	{	
		$categories = TheCategoryLibrary::orderBy('id', 'desc')->get();
		return View::make('admin.library_categories', compact('categories'));
	}


	public function categorie_store()
	{
		if (Request::ajax()){

	
			$inputs = Input::all();
			$validation = Validator::make($inputs, ['name'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 

			else {
	
				$category = TheCategoryLibrary::create([
					'name' => e($inputs['name'])
				]);

				return 'true';
			}

        }
	}

	public function categorie_update($id)
	{
		if (Request::ajax()){

			$inputs = Input::all();
			$validation = Validator::make($inputs, ['name'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 

			else {
				$Category = TheCategoryLibrary::find($id);

				$Category->name = e($inputs['name']);
				$Category->save();

				return 'true';
			}

        }
	}


	public function categorie_destroy($id)
	{
		$Category = TheCategoryLibrary::find($id);

		if ($Category !== null) {

			// remove form library
			$files = Library::where('category_id', $Category->id)->get();
			foreach ($files as $file) {
				$file->category_id = 0;
				$file->save();
			}

			$Category->delete();

			$path = Session::get('language');
			return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

		}
	}


	
	public function store()
	{	

		$inputs = Input::all();

			$validation = Validator::make($inputs, $this->rules);

			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation)->withCss('<style type="text/css">.collapse{display:block;}</style>');
			} 

			else {


				if (Input::hasFile('file')) {

					$date = date('Y-m-d');
					
					$path = 'uploads/library/'.$date.'/';

					$filename = Input::file('file')->getClientOriginalName();
					$filename = strtolower($filename);
					$filename = str_ireplace(' ', '_', $filename);

					$new_name = round(microtime(true)).'_'. $filename;

					$upload_img = Input::file('file')->move($path, $new_name);

					$library = Library::create([
						'user_id'=> Auth::user()->id,
						'file_name'=> e($inputs['file_name']),
						'category_id'=> e($inputs['category_id']),
						'file_path'=> $date . '/' . $new_name
					]);

					$library->save();

					$path = Session::get('language');
					return Redirect::back()->with('success', Lang::get($path.'.file_upload_success'));

				}
			}
	}



	
	public function destroy($id)
	{
		$library = Library::find($id);

		if ($library !== null) {

			if ($library->user_id == Auth::user()->id OR Auth::user()->is_admin == true) {

					// delete  file
					if (!empty($library->file_path)) {
						unlink(public_path()."/uploads/library/".$library->file_path);
					}

					// delete
					$library->delete();

					$path = Session::get('language');
					return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

			} else {
				return Redirect::route('home');
			}

		} else {
			return Redirect::route('home');
		}

	}


}

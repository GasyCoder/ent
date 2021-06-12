<?php

class ArticlesController extends BaseController {

	

	protected $rules = [

			'title'=>'required|min:3',
			'content'=>'required',
			'image'=>'image|max:1000'

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
		$articles = Article::orderBy('id', 'desc')->paginate(15);
		return View::make('admin.articles', compact('articles'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	
		$categories = Category::all();
		return View::make('admin.new_article', compact('categories'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
			$inputs = Input::all();

			$validation = Validator::make($inputs, $this->rules);

			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);
			} 

			else {
		

				if (Input::hasFile('image')) {

					$date = date('Y-m-d');
					
					$path = 'uploads/articles/'.$date.'/';

					$image_name = Input::file('image')->getClientOriginalName();
					$image_name = strtolower($image_name);
					$image_name = str_ireplace(' ', '_', $image_name);

					$image_new_name = round(microtime(true)).'_'. $image_name;

					$upload_img = Input::file('image')->move($path, $image_new_name);

					$article = Article::create([

					'title'=> e($inputs['title']),
					'slug'=> $this->make_slug($inputs['title']),
					'content'=> e($inputs['content']),
					'category_id'=> e($inputs['category_id']),
					'image'=> $date . '/' . $image_new_name
					
					]);

				} 

				else {

					$article = Article::create([

					'title'=>e($inputs['title']),
					'slug'=>$this->make_slug($inputs['title']),
					'content'=>e($inputs['content']),
					'category_id'=> e($inputs['category_id'])
					
					]);

				}

				$article->save();

				$path = Session::get('language');
				return Redirect::back()->with('success', Lang::get($path.'.success_added'));

			}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{	
		$article = Article::find($id);

		if ($article !== null) {

			$comments = $article->comments;
			return View::make('article', compact('article', 'comments'));

		} 

		else {
			return View::make('404');
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$article = Article::find($id);

		$categories_array = Category::lists('name', 'id');

		if ($article !== null) {
			return View::make('admin.update_article', compact('article', 'categories_array'));
		} else {
			return Redirect::back('admin_articles');
		}

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$article = Article::find($id);
		if ($article !== null) {

			$inputs = Input::all();
			
			if (Input::hasFile('image')) {

					// delete old image
					if (!empty($article->image)) {
						unlink(public_path()."/uploads/articles/".$article->image);
					}
					
					$image = Input::file('image');

					$date = date('Y-m-d');
					$path = 'uploads/articles/'.$date.'/';

					$filename = $image->getClientOriginalName();
					$filename = strtolower($filename);
					$filename = str_ireplace(' ', '_', $filename);
					$filename = round(microtime(true)).'_'. $filename;

					$upload_success = $image->move($path, $filename);

					$article->title = e($inputs['title']);
					$article->slug = $this->make_slug($inputs['title']);
					$article->content = e($inputs['content']);
					$article->image = $date . '/' . $filename;
					$article->category_id = e($inputs['category_id']);



				} else {

					$article->title = e($inputs['title']);
					$article->slug = $this->make_slug($inputs['title']);
					$article->content = e($inputs['content']);
					$article->category_id = e($inputs['category_id']);


				}

				
				$article->save();

				$path = Session::get('language');
				return Redirect::back()->withSuccess(Lang::get($path.'.Modified_successfully'));


		} else {
			return Redirect::route('admin_articles');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
		$article = Article::find($id);

		if ($article !== null) {

			// delete comment
			$comment = Comment::where('article_id', $id);
			$comment->delete();

			// delete image
			if (!empty($article->image)) {
				unlink(public_path()."/uploads/articles/".$article->image);
			}

			// delete article
			$article->delete();

			$path = Session::get('language');
			return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

		} else {
			return Redirect::route('admin_articles');
		}

		
	}


/*---------------------- comments -----------------------*/


	// store comments 
	public function comment_store($id) {
		
		$article = Article::find($id);

		$inputs = Input::all();

		Comment::create([

			'content' => e($inputs['content']),
			'user_id' => Auth::user()->id,
			'article_id' => $article->id 

		]);

		$article->count_comment = $article->count_comment + 1 ;
		$article->save();

		$path = Session::get('language');
		return Redirect::back()->with('success', Lang::get($path.'.comment_added_with_success'));

	}

	// delete comment
	public function comment_delete($id){

	
		$comment = Comment::find($id);

		// get the article id
		$article_id = $comment->article_id;

		// find article and count_comment - 1
		$article = Article::find($article_id);
		$article->count_comment = $article->count_comment-1;
		$article->save();

		// delete comment
		$comment->delete();


		return Redirect::back();

		
	}


/*----------------- categories ------------------------------*/


	public function category($id){

		$category = Category::find($id);

		if ($category !== null) {

			$articles = Article::where('category_id', $category->id)->orderBy('id', 'desc')->paginate(3);
			return View::make('category', compact('articles', 'category'));

		} else {
			return View::make('404');
		}
		
	}
	
	
	
	public function categories(){

		$categories = Category::orderBy('id', 'desc')->get();
		return View::make('admin.categories', compact('categories'));
		
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
	
				$category = Category::create([

					'name' => e($inputs['name']),
					'slug' => $this->make_slug($inputs['name'])

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
				$Category = Category::find($id);

				$Category->name = e($inputs['name']);
				$Category->slug = $this->make_slug($inputs['name']);
				$Category->save();

				return 'true';
			}

        }
	}


	public function categorie_destroy($id)
	{
		$Category = Category::find($id);

		if ($Category !== null) {

			// remove form articles
			$articles = Article::where('category_id', $Category->id)->get();
			foreach ($articles as $article) {
				$article->category_id = 0;
				$article->save();
			}

			$Category->delete();

			$path = Session::get('language');
			return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

		}
	}


}

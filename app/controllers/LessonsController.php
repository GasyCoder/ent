<?php

class LessonsController extends BaseController {

	protected $rules = [

			'title'=>'required|min:3',
			'content'=>'required',
			'subject_id'=>'required',
			'class_id'=>'required',
			'file[]'=>'mimes:doc,docx,ppt,pptx,pdf'

	];


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user_id = Auth::user()->id;
		$lessons = Lesson::where('teacher_id', $user_id)->orderBy('id', 'desc')->paginate(15);
		return View::make('teachers.lessons', compact('lessons'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user_id = Auth::user()->id;

		$subjects = Subject::where('teacher_id', $user_id)->get();

		$classes_array = array();

		foreach ($subjects as $subject) {
			$classes_array[] = $subject->class_id;
		}

		$classes = TheClass::whereIn('id', $classes_array)->get();

		return View::make('teachers.new_lesson', compact('subjects', 'classes'));
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
		
				$user_id = Auth::user()->id;

				if (Input::hasFile('file')) {

					$files = Input::file('file');
					$files_array = array();


if (count($files_array) > 6) {
	return Redirect::back()->withInput()->with('error', 'maximum 6 fichiers');
}

					foreach($files as $file) {


						$path = 'uploads/lessons/';

						$filename = $file->getClientOriginalName();
						$filename = strtolower($filename);
						$filename = str_ireplace(' ', '_', $filename);

						$new_name = round(microtime(true)).'_'. $filename;

						$upload_file = $file->move($path, $new_name);


						$files_array[] = 	$new_name;
						

					}

				
				$all_files = implode(",", $files_array);

	
					$lesson = Lesson::create([

					'title'=> e($inputs['title']),
					'content'=> e($inputs['content']),
					'jointe'=> $all_files,
					'teacher_id'=> $user_id,
					'class_id'=> e($inputs['class_id']),

					'mention' => e(Input::get('mention')),
					'parcour' => e(Input::get('parcour')),

					'subject_id'=> e($inputs['subject_id'])

					
					]);

				} 

				else {

					$lesson = Lesson::create([

					'title'=> e($inputs['title']),
					'content'=> e($inputs['content']),
					'teacher_id'=> $user_id,
					'class_id'=> e($inputs['class_id']),

					'mention' => e(Input::get('mention')),
					'parcour' => e(Input::get('parcour')),

					'subject_id'=> e($inputs['subject_id'])

					
					]);

				}

				$lesson->save();

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
		$lesson = Lesson::find($id);

		if ($lesson !== null) {

			$comments_nav = LessonsComment::where('read', 0)->where('lesson_id', $lesson->id)->update(array('read' => 1));
			
			return View::make('teachers.show_lesson', compact('lesson'));

		} else {
			return Redirect::route('teacher_lessons');
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
		$lesson = Lesson::find($id);

		if ($lesson !== null) {

			$user_id = Auth::user()->id;

			$subjects = Subject::where('teacher_id', $user_id)->get();

			$classes_array = array();

			foreach ($subjects as $subject) {
				$classes_array[] = $subject->class_id;
			}

			$classes = TheClass::whereIn('id', $classes_array)->lists('name', 'id');

			return View::make('teachers.update_lesson', compact('lesson', 'subjects', 'classes'));

		} else {
			return Redirect::route('teacher_lessons');
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
		$lesson = Lesson::find($id);
		if ($lesson !== null) {

			if ($lesson->teacher_id == Auth::user()->id) {
				
					$inputs = Input::all();

					$validation = Validator::make($inputs, $this->rules);

					if ($validation->fails()) {
						return Redirect::back()->withInput()->withErrors($validation);
					} 

					else {
				
						if (Input::hasFile('file')) {

							// delete old file
							if (!empty($lesson->jointe)) {

								$one_files = explode(",", $lesson->jointe);

								foreach ($one_files as $on) {
									unlink(public_path()."/uploads/lessons/".$on);
								}
							}


							$files = Input::file('file');
							$files_array = array();


		if (count($files_array) > 6) {
			return Redirect::back()->withInput()->with('error', 'maximum 6 fichiers');
		}					

							foreach($files as $file) {

								$path = 'uploads/lessons/';

								$filename = $file->getClientOriginalName();
								$filename = strtolower($filename);
								$filename = str_ireplace(' ', '_', $filename);

								$new_name = round(microtime(true)).'_'. $filename;

								$upload_file = $file->move($path, $new_name);


								$files_array[] = 	$new_name;
								
							}

							$all_files = implode(",", $files_array);

							
							$lesson->title = e($inputs['title']);
							$lesson->content = e($inputs['content']);
							$lesson->jointe = $all_files;
							$lesson->class_id = e($inputs['class_id']);
							$lesson->subject_id = e($inputs['subject_id']);

							$lesson->mention = e($inputs['mention']);
							$lesson->parcour = e($inputs['parcour']);


						} 

						else {

							$lesson->title = e($inputs['title']);
							$lesson->content = e($inputs['content']);
							$lesson->class_id = e($inputs['class_id']);
							$lesson->subject_id = e($inputs['subject_id']);

							$lesson->mention = e($inputs['mention']);
							$lesson->parcour = e($inputs['parcour']);


						}

						$lesson->save();

						$path = Session::get('language');
						return Redirect::back()->with('success', Lang::get($path.'.Modified_successfully'));

					}

			} else {
			return Redirect::route('teacher_lessons');
		}


		} else {
			return Redirect::route('teacher_lessons');
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
		$lesson = Lesson::find($id);

		if ($lesson !== null) {

			if ($lesson->teacher_id == Auth::user()->id) {

					// delete  file
					if (!empty($lesson->jointe)) {
						
						$one_files = explode(",", $lesson->jointe);

						foreach ($one_files as $on) {
							unlink(public_path()."/uploads/lessons/".$on);
						}

					}

					// delete lesson
					$lesson->delete();

					$path = Session::get('language');
					return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

			} else {
				return Redirect::route('teacher_lessons');
			}

		} else {
			return Redirect::route('teacher_lessons');
		}
	}


	/*--------------------------------------------------*/


	// store lessons comments 
	public function comment_store($id) {
		
		$lesson = Lesson::find($id);

		$inputs = Input::all();

		LessonsComment::create([

			'content' => e($inputs['content']),
			'user_id' => Auth::user()->id,
			'lesson_id' => $lesson->id 

		]);

		$path = Session::get('language');
		return Redirect::back()->with('success', Lang::get($path.'.comment_added_with_success'));

	}

	// delete lessons comments
	public function comment_delete($id){
	
		$comment = LessonsComment::find($id);
		$comment->delete();
		return Redirect::back();

		
	}


	public function search_lessons()
	{	
		$inputs = Input::all();
		$text_query = e(Input::get('q'));

		if (!empty($text_query)) {
	
			$lessons = Lesson::where('teacher_id', Auth::user()->id);

			if(Input::has('q')) {
				$lessons->where('title', 'like', '%' .$text_query. '%')->orWhere('content', 'like', '%' .$text_query. '%');
			}

			$lessons = $lessons->paginate(15);

			return View::make('teachers.lessons', compact('lessons'), [ 'lessons' => $lessons->appends(Input::except('page')) ]);

		} 

		else {
			$lessons = Lesson::where('teacher_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(15);
			return View::make('teachers.lessons', compact('lessons'));
		}
	}


	public function student_search_lessons()
	{	
		$inputs = Input::all();
		$text_query = e(Input::get('q'));

		if (!empty($text_query)) {


			$student_class_id = Auth::user()->class_id;

			$student_mention = Auth::user()->mention;
			$student_parcour = Auth::user()->parcour;
	
			$lessons = Lesson::where('class_id', $student_class_id)->where('mention', $student_mention)->where('parcour', $student_parcour);

			if(Input::has('q')) {
				$lessons->where('title', 'like', '%' .$text_query. '%')->orWhere('content', 'like', '%' .$text_query. '%');
			}

			$lessons = $lessons->paginate(15);

			return View::make('students.lessons', compact('lessons'), [ 'lessons' => $lessons->appends(Input::except('page')) ]);

		} 

		else {

			$student_class_id = Auth::user()->class_id;

			$student_mention = Auth::user()->mention;
			$student_parcour = Auth::user()->parcour;


			$lessons = Lesson::where('class_id', $student_class_id)->where('mention', $student_mention)->where('parcour', $student_parcour)->orderBy('id', 'desc')->paginate(15);
			return View::make('students.lessons', compact('lessons'));

		}
	}




	


}

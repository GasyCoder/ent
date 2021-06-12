<?php

class StudentsController extends BaseController {


	protected $rules = [

			'fullname'=>'required',
			'username'=>'required|min:6|unique:users',
			'email'=>'email|unique:users',
			'password'=>'required|min:8',
			'password_confirm'=>'required|same:password'

	];

	public function index()
	{
		return View::make('users.index');
	}


	public function all_students()
	{

		$inputs = Input::all();
		$text_query = e(Input::get('q'));

		if (!empty($text_query)) {

			$students = User::where('is_student', true);

			if(Input::has('q')) {
				$students->where('fullname', 'like', '%' .$text_query. '%')->orWhere('registration_num', $text_query);
			}

			$students = $students->paginate(15);

			return View::make('admin.students', compact('students'), [ 'students' => $students->appends(Input::except('page')) ]);
		}

		else {

			$students = User::where('is_student', true)->orderBy('fullname', 'asc')->paginate(15);
			return View::make('admin.students', compact('students'));
		}


	}



	public function profile($id)
	{
		$user = User::find($id);
		if ($user !== null) {
			return View::make('admin.user_profile', compact('user'));
		} else {
			return Redirect::route('admin_students');
		}
	}

	public function teacher_profile($id)
	{	
		$user = User::find($id);
		if ($user !== null) {
			return View::make('students.user_profile', compact('user'));
		} else {
			return Redirect::route('student_teachers');
		}
		
	}


	public function create()
	{
		$parents = User::where('is_parent', true)->get();
		$classes = TheClass::all();

		return View::make('admin.new_student', compact('parents', 'classes'));
	}


	public function store()
	{
			$inputs = Input::all();

			$validation = Validator::make($inputs, $this->rules);

			if ($validation->fails()) {

				return Redirect::back()->withInput()->withErrors($validation);

			} else {

				if (Input::hasFile('image')) {

					$image = Input::file('image');

					$destinationPath = 'uploads/profiles/students';

					$filename = $image->getClientOriginalName();
					$filename = strtolower($filename);
					$filename = str_ireplace(' ', '_', $filename);
					$filename = round(microtime(true)).'_'. $filename;

					$upload_success = $image->move($destinationPath, $filename);

					$user = User::create([

						'class_id' => e(Input::get('class')),
						'registration_num' => e(Input::get('registration_num')),
						'is_student' => 1,

						'mention' => e(Input::get('mention')),
						'parcour' => e(Input::get('parcour')),


						'fullname' => e(Input::get('fullname')),
						'gender' => e(Input::get('gender')),
						'username' => e(Input::get('username')),
						'password' => Hash::make(e(Input::get('password'))),

						'birthday' => e(Input::get('birthday')),
						'birth_localite' => e(Input::get('birth_localite')),
						'region' => e(Input::get('region')),
						'address' => e(Input::get('address')),
						'email' => e(Input::get('email')),
						'phone' => e(Input::get('phone')),
						'image' => $filename
					]);

				} else {

					$user = User::create([

						'class_id' => e(Input::get('class')),
						'registration_num' => e(Input::get('registration_num')),
						'is_student' => 1,

						'mention' => e(Input::get('mention')),
						'parcour' => e(Input::get('parcour')),

						'fullname' => e(Input::get('fullname')),
						'gender' => e(Input::get('gender')),
						'username' => e(Input::get('username')),
						'password' => Hash::make(e(Input::get('password'))),

						'birthday' => e(Input::get('birthday')),
						'birth_localite' => e(Input::get('birth_localite')),
						'region' => e(Input::get('region')),
						'address' => e(Input::get('address')),
						'email' => e(Input::get('email')),
						'phone' => e(Input::get('phone'))
					]);

				}


				$user->save();

				$path = Session::get('language');
				return Redirect::back()->with('success', Lang::get($path.'.success_added'));
			}
	}



	public function edit($id)
	{
		$user = User::find($id);
		if ($user !== null) {
			return View::make('admin.update_student', compact('user'));
		} else {
			return Redirect::route('admin_students');
		}

	}



	public function update($id)
	{
		$user = User::find($id);
		if ($user !== null) {

			$inputs = Input::all();

			if (Input::hasFile('image')) {

					// delete old image
					if (!empty($user->image)) {
						unlink(public_path()."/uploads/profiles/students/".$user->image);
					}

					$image = Input::file('image');

					$destinationPath = 'uploads/profiles/students';

					$filename = $image->getClientOriginalName();
					$filename = strtolower($filename);
					$filename = str_ireplace(' ', '_', $filename);
					$filename = round(microtime(true)).'_'. $filename;

					$upload_success = $image->move($destinationPath, $filename);

					$user->fullname = e($inputs['fullname']);
					$user->gender = e($inputs['gender']);


					$user->class_id = e($inputs['class']);
					$user->registration_num = e($inputs['registration_num']);

					$user->mention = e($inputs['mention']);
					$user->parcour = e($inputs['parcour']);


					$user->birthday = e($inputs['birthday']);
					$user->birth_localite = e($inputs['birth_localite']);
					$user->region = e($inputs['region']);
					$user->address = e($inputs['address']);
					$user->email = e($inputs['email']);
					$user->phone = e($inputs['phone']);
					$user->image = $filename;


				} else {

					$user->fullname = e($inputs['fullname']);
					$user->gender = e($inputs['gender']);


					$user->class_id = e($inputs['class']);
					$user->registration_num = e($inputs['registration_num']);

					$user->mention = e($inputs['mention']);
					$user->parcour = e($inputs['parcour']);

					$user->birthday = e($inputs['birthday']);
					$user->birth_localite = e($inputs['birth_localite']);
					$user->region = e($inputs['region']);
					$user->address = e($inputs['address']);
					$user->email = e($inputs['email']);
					$user->phone = e($inputs['phone']);

				}


				$user->save();

				$path = Session::get('language');
				return Redirect::back()->withSuccess(Lang::get($path.'.Modified_successfully'));


		} else {
			return Redirect::route('admin_students');
		}
	}



	public function update_password($id)
	{
		$user = User::find($id);
		if ($user !== null) {

			$inputs = Input::all();

			$user->password = Hash::make(e(Input::get('password')));
			$user->save();

			$path = Session::get('language');
			return Redirect::back()->withSuccess(Lang::get($path.'.Modified_successfully'));

		} else {
			return Redirect::route('admin_students');
		}
	}



	public function destroy($id)
	{
		$user = User::find($id);

		if ($user !== null) {

			// delete absences
			$absences = Absence::where('user_id', $user->id)->delete();

			// delete reports
			$report = Report::where('student_id', $user->id)->delete();

			// delete marks
			$marks = Marks::where('student_id', $user->id)->delete();

			// delete messages
			$messages = Message::where('receiver_id', $user->id)->get();
			foreach ($messages as $message) {
				$message->delete();
			}

			$messages_2 = Message::where('sender_id', $user->id)->get();
			foreach ($messages_2 as $message_2) {
				$message_2->delete();
			}

			// delete comments
			$comments = Comment::where('user_id', $user->id)->delete();


			// delete image
	        if (!empty($user->image)) {
	            unlink(public_path()."/uploads/profiles/students/".$user->image);
	        }


	        // remove form library
			$library = Library::where('user_id', $user->id)->get();
			foreach ($library as $l) {
				$l->user_id = 0;
				$l->save();
			}

			// delete payments
			$payments = Payments::where('student_id', $user->id)->delete();

			$user->delete();

			$path = Session::get('language');
			return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

		}

		else {
			return Redirect::back();
		}


	}




	/*--------------------------------------------------------------------------*/


	public function payments()
	{
		$student_id = Auth::user()->id;
		$payments = Payments::where('student_id', $student_id)->orderBy('id', 'desc')->paginate(15);
		return View::make('users.payments', compact('payments'));
	}

	public function payment_invoice($id)
	{
		$payment = Payments::find($id);
		$control = Control::find(1);

		$payment_amount = $payment->payment_amount;
		$payment_Tax = $control->payment_tax;

		$tax = $payment_amount * $payment_Tax / 100 ;

		$total = $tax + $payment_amount;

		if ($payment !== null) {
			return View::make('users.payment_invoice', compact('payment', 'tax', 'total', 'control'));
		}

		else {
			return Redirect::back('home');
		}

	}


	public function subjects()
	{

		$class_id = Auth::user()->class_id;

		$subjects = Subject::where('class_id', $class_id)->orderBy('id', 'desc')->paginate(15);

		return View::make('students.subjects', compact('subjects'));
	}

	public function teachers()
	{

		$class_id = Auth::user()->class_id;

		$student_subjects = Subject::where('class_id', $class_id)->get();

		$teachers_array = array();

		foreach ($student_subjects as $student_subject) {

			$teachers_array[] = $student_subject->teacher_id;

		}


		$teachers = User::where('is_teacher', true)->whereIn('id', $teachers_array)->orderBy('fullname', 'asc')->paginate(15);

		return View::make('students.teachers', compact('teachers'));

	}


	public function absences() {

		$user_id = Auth::user()->id;

		$absences = Absence::where('user_id', $user_id)->orderBy('id', 'desc')->paginate(15);

		return View::make('students.absences', compact('absences'));
	}



	public function exams()
	{
		$class_id = Auth::user()->class_id;

		$exams = Exam::where('class_id', $class_id)->orderBy('id', 'desc')->paginate(15);

		return View::make('students.exams', compact('exams'));
	}


	public function marks()
	{
		$user_id = Auth::user()->id;

		$marks = Marks::where('student_id', $user_id)->orderBy('id', 'desc')->paginate(15);

		return View::make('students.marks', compact('marks'));
	}

	public function edit_profile()
	{
		$user_id = Auth::user()->id;

		$user = User::find($user_id);

		return View::make('students.edit_profile', compact('user'));


	}


	public function update_profile()
	{

		$user_id = Auth::user()->id;

		$user = User::find($user_id);

		$inputs = Input::all();

		$validation = Validator::make($inputs, ['email'=>'email']);

		if ($validation->fails()) {

			return Redirect::back()->withErrors($validation);

		} else {


				if (Input::hasFile('image')) {

					// delete old image
					if (!empty($user->image)) {
						unlink(public_path()."/uploads/profiles/students/".$user->image);
					}

					$image = Input::file('image');

					$destinationPath = 'uploads/profiles/students';

					$filename = $image->getClientOriginalName();
					$filename = strtolower($filename);
					$filename = str_ireplace(' ', '_', $filename);
					$filename = round(microtime(true)).'_'. $filename;

					$upload_success = $image->move($destinationPath, $filename);

					$user->address = e($inputs['address']);
					$user->email = e($inputs['email']);
					$user->phone = e($inputs['phone']);
					$user->image = $filename;


				} else {

					$user->address = e($inputs['address']);
					$user->email = e($inputs['email']);
					$user->phone = e($inputs['phone']);

				}


				$user->save();

				$path = Session::get('language');
				return Redirect::back()->withSuccess(Lang::get($path.'.Modified_successfully'));


		}


	}



	public function student_update_password()
	{

		$user_id = Auth::user()->id;

		$user = User::find($user_id);

		$inputs = Input::all();

		$validation = Validator::make($inputs, ['old_password'=>'required', 'password'=>'required|min:4', 'password_confirm'=>'required|same:password']);


		if ($validation->fails()) {

			return Redirect::back()->withErrors($validation);

		} else {

			$old_password = Input::get('old_password');

			if (Hash::check($old_password, $user->password)) {

				$user->password = Hash::make($inputs['password']);
				$user->save();

				$path = Session::get('language');
				return Redirect::back()->withSuccess(Lang::get($path.'.Information_modified'));

			}

			else {
				$path = Session::get('language');
				return Redirect::back()->withError(Lang::get($path.'.password_error'));

			}


		}


	}


	public function lessons()
	{
		$student_class_id = Auth::user()->class_id;

		$student_mention = Auth::user()->mention;
		$student_parcour = Auth::user()->parcour;


		$lessons = Lesson::where('class_id', $student_class_id)->where('mention', $student_mention)->where('parcour', $student_parcour)->orderBy('id', 'desc')->paginate(15);
		return View::make('students.lessons', compact('lessons'));
	}


	public function lesson_show($id)
	{
		$student_class_id = Auth::user()->class_id;

		$lesson = Lesson::find($id);

		if ($lesson !== null) {

			if ($lesson->class_id == $student_class_id) {
				return View::make('students.show_lesson', compact('lesson'));
			} else {
				return Redirect::route('student_lessons');
			}

		} else {
			return Redirect::route('student_lessons');
		}
	}


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



}

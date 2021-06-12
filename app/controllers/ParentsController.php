<?php

class ParentsController extends BaseController {

	protected $rules = [

			'fullname'=>'required',
			'username'=>'required|min:3|unique:users',
			'email'=>'email|unique:users',
			'password'=>'required|min:4',
			'password_confirm'=>'required|same:password'

	];

	public function index()
	{	
		return View::make('users.index');
	}


	public function all_parents()
	{	
		
		$inputs = Input::all();
		$text_query = e(Input::get('q'));

		if (!empty($text_query)) {
	
			$parents = User::where('is_parent', true);

			if(Input::has('q')) {
				$parents->where('fullname', 'like', '%' .$text_query. '%');
			}

			$parents = $parents->paginate(15);

			return View::make('admin.parents', compact('parents'), [ 'parents' => $parents->appends(Input::except('page')) ]);
		} 

		else {
			$parents = User::where('is_parent', true)->orderBy('fullname', 'asc')->paginate(15);
			return View::make('admin.parents', compact('parents'));
		}

	}


	public function profile($id)
	{
		$user = User::find($id);
		if ($user !== null) {
			return View::make('admin.user_profile', compact('user'));
		} else {
			return Redirect::route('admin_parents');
		}
	}



	public function all_childrens($id)
	{	
		$parent = User::find($id);
		if ($parent !== null) {

			$students = User::where('is_student', true)->where('guardian_id', $id)->orderBy('fullname', 'asc')->paginate(15);
			return View::make('admin.parent_childrens', compact('students', 'parent'));

		} else {
			return Redirect::route('admin_parents');
		}
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.new_parent');
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

			} else {

				if (Input::hasFile('image')) {

					$image = Input::file('image');

					$destinationPath = 'uploads/profiles/parents';

					$filename = $image->getClientOriginalName();
					$filename = strtolower($filename);
					$filename = str_ireplace(' ', '_', $filename);
					$filename = round(microtime(true)).'_'. $filename;

					$upload_success = $image->move($destinationPath, $filename);

					$user = User::create([
						
						'is_parent' => 1,

						'fullname' => e(Input::get('fullname')),
						'gender' => e(Input::get('gender')),
						'username' => e(Input::get('username')),
						'password' => Hash::make(e(Input::get('password'))),

						'address' => e(Input::get('address')),
						'email' => e(Input::get('email')),
						'phone' => e(Input::get('phone')),
						'image' => $filename

					]);

				} else {

					$user = User::create([

						'is_parent' => 1,

						'fullname' => e(Input::get('fullname')),
						'gender' => e(Input::get('gender')),
						'username' => e(Input::get('username')),
						'password' => Hash::make(e(Input::get('password'))),

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


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		if ($user !== null) {
			return View::make('admin.update_parent', compact('user'));
		} else {
			return Redirect::route('admin_parents');
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
		$user = User::find($id);
		if ($user !== null) {

			$inputs = Input::all();
			
			if (Input::hasFile('image')) {

					// delete old image
					if (!empty($user->image)) {
						unlink(public_path()."/uploads/profiles/parents/".$user->image);
					}
					
					$image = Input::file('image');

					$destinationPath = 'uploads/profiles/parents';

					$filename = $image->getClientOriginalName();
					$filename = strtolower($filename);
					$filename = str_ireplace(' ', '_', $filename);
					$filename = round(microtime(true)).'_'. $filename;

					$upload_success = $image->move($destinationPath, $filename);

					$user->fullname = e($inputs['fullname']);
					$user->gender = e($inputs['gender']);
					
					$user->address = e($inputs['address']);
					$user->email = e($inputs['email']);
					$user->phone = e($inputs['phone']);
					$user->image = $filename;


				} else {

					$user->fullname = e($inputs['fullname']);
					$user->gender = e($inputs['gender']);

					$user->address = e($inputs['address']);
					$user->email = e($inputs['email']);
					$user->phone = e($inputs['phone']);

				}

				
				$user->save();
				$path = Session::get('language');
				return Redirect::back()->withSuccess(Lang::get($path.'.Modified_successfully'));


		} else {
			return Redirect::route('admin_parents');
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
			return Redirect::route('admin_parents');
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
		$user = User::find($id);

		if ($user !== null) {

			// delete comments
			$comments = Comment::where('user_id', $user->id)->delete();

			// delete image
	        if (!empty($user->image)) {
	            unlink(public_path()."/uploads/profiles/parents/".$user->image);
	        }

	        // delete messages
			$messages = Message::where('receiver_id', $user->id)->get();
			foreach ($messages as $message) {
				$message->delete();
			}

			$messages_2 = Message::where('sender_id', $user->id)->get();
			foreach ($messages_2 as $message_2) {
				$message_2->delete();
			}

			// remove as guardian of students
			$as_guardian = User::where('guardian_id', $user->id)->get();
			foreach ($as_guardian as $guardian) {
				$guardian->guardian_id = 0;
				$guardian->save();
			}

			

			$user->delete();

			$path = Session::get('language');
			return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

		} 
		else {
			return Redirect::back();
		}
	}






/*-----------------------------------------------------------------------*/


	public function students()
	{	
		$user_id = Auth::user()->id;

		$students = User::where('is_student', true)->where('guardian_id', $user_id)->orderBy('fullname', 'asc')->paginate(15);

		return View::make('parents.students', compact('students'));
		
	}

	public function payments()
	{	
		
		// get childrens
		$user_id = Auth::user()->id;
		$students = User::where('is_student', true)->where('guardian_id', $user_id)->get();

		$students_array = array();

		foreach ($students as $student) {
			$students_array[] = $student->id;
		}


		$payments = Payments::whereIn('student_id', $students_array)->orderBy('id', 'desc')->paginate(15);
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


	public function exams()
	{

		// get childrens
		$user_id = Auth::user()->id;
		$students = User::where('is_student', true)->where('guardian_id', $user_id)->get();

		$exams_array = array();

		foreach ($students as $student) {
			$exams_array[] = $student->class_id;
		}

		$exams = Exam::whereIn('class_id', $exams_array)->orderBy('id', 'desc')->paginate(15);

		return View::make('parents.exams', compact('exams'));
	}


	public function marks()
	{
		// get childrens
		$user_id = Auth::user()->id;
		$students = User::where('is_student', true)->where('guardian_id', $user_id)->get();

		$marks_array = array();

		foreach ($students as $student) {
			$marks_array[] = $student->id;
		}


		$marks = Marks::whereIn('student_id', $marks_array)->orderBy('id', 'desc')->paginate(15);


		return View::make('parents.marks', compact('marks'));
	}


	public function student_marks($id)
	{

		$user_id = Auth::user()->id;

		$student = User::find($id);

		if ($student->guardian_id == $user_id ) {
			$marks = Marks::where('student_id', $id)->orderBy('id', 'desc')->paginate(15);
			return View::make('parents.student_marks', compact('marks'));
		}

	}


	public function reports()
	{
		// get childrens
		$user_id = Auth::user()->id;
		$students = User::where('is_student', true)->where('guardian_id', $user_id)->get();

		$reports_array = array();

		foreach ($students as $student) {
			$reports_array[] = $student->id;
		}

		$reports = Report::whereIn('student_id', $reports_array)->where('to_parent', true)->orderBy('id', 'desc')->paginate(15);


		return View::make('parents.reports', compact('reports'));
	}

	public function student_reports($id)
	{

		$user_id = Auth::user()->id;

		$student = User::find($id);

		if ($student->guardian_id == $user_id ) {
			$reports = Report::where('student_id', $id)->where('to_parent', true)->orderBy('id', 'desc')->paginate(15);
			return View::make('parents.student_reports', compact('reports'));
		}

	}




	public function absences()
	{
		// get childrens
		$user_id = Auth::user()->id;
		$students = User::where('is_student', true)->where('guardian_id', $user_id)->get();

		$absences_array = array();

		foreach ($students as $student) {
			$absences_array[] = $student->id;
		}

		$absences = Absence::whereIn('user_id', $absences_array)->orderBy('id', 'desc')->paginate(15);


		return View::make('parents.absences', compact('absences'));
	}


	public function teachers()
	{
		// get childrens
		$user_id = Auth::user()->id;
		$students = User::where('is_student', true)->where('guardian_id', $user_id)->get();

		$classes_array = array();

		foreach ($students as $student) {
			$classes_array[] = $student->class_id;
		}

		$subjects = Subject::whereIn('class_id', $classes_array)->orderBy('id', 'desc')->get();


		$teachers_array = array();

		foreach ($subjects as $subject) {
			$teachers_array[] = $subject->teacher_id;
		}

		$teachers = User::whereIn('id', $teachers_array)->where('is_teacher', true)->paginate(15);

		return View::make('parents.teachers', compact('teachers'));
	}


	/*------------------------------------------------------------------*/

	public function edit_profile()
	{
		$user_id = Auth::user()->id;

		$user = User::find($user_id);

		return View::make('parents.edit_profile', compact('user'));

		
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
						unlink(public_path()."/uploads/profiles/parents/".$user->image);
					}
					
					$image = Input::file('image');

					$destinationPath = 'uploads/profiles/parents';

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
				return Redirect::back()->withSuccess(Lang::get($path.'.Information_modified'));


		}

		
	}



	public function teacher_update_password()
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

	/*-------------------------------------------------*/











}

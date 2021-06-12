<?php

class TeachersController extends BaseController {


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

	
	public function all_teachers()	
	{	
		
		$inputs = Input::all();
		$text_query = e(Input::get('q'));

		if (!empty($text_query)) {
	
			$teachers = User::where('is_teacher', true);

			if(Input::has('q')) {
				$teachers->where('fullname', 'like', '%' .$text_query. '%')->orWhere('phone', $text_query)->orWhere('grade', $text_query);
			}

			$teachers = $teachers->paginate(15);

			return View::make('admin.teachers', compact('teachers'), [ 'teachers' => $teachers->appends(Input::except('page')) ]);
		} 

		else {
			$teachers = User::where('is_teacher', true)->orderBy('fullname', 'asc')->paginate(15);
			return View::make('admin.teachers', compact('teachers'));
		}
	}


	public function scolarite()
	{
		$managers = User::where('is_manager', true)->orderBy('fullname', 'asc')->paginate(15);
		
		return View::make('teachers.scolarite', compact('managers'));
		
	}


	public function annuaire_teachers()
	{	
		
		$inputs = Input::all();
		$text_query = e(Input::get('q'));

		if (!empty($text_query)) {
	
			$teachers = User::where('is_teacher', true);

			if(Input::has('q')) {
				$teachers->where('fullname', 'like', '%' .$text_query. '%');
			}

			$teachers = $teachers->paginate(30);

			return View::make('admin.annuaire', compact('teachers'), [ 'teachers' => $teachers->appends(Input::except('page')) ]);
		} 

		else {
			$teachers = User::where('is_teacher', true)->orderBy('fullname', 'asc')->paginate(30);
			return View::make('admin.annuaire', compact('teachers'));
		}
	}


	
	public function t_annuaire_teachers()
	{	
		$user_id = Auth::user()->id;



		$inputs = Input::all();
		$text_query = e(Input::get('q'));

		if (!empty($text_query)) {
	
			$teachers = User::where('is_teacher', true);

			if(Input::has('q')) {
				$teachers->where('fullname', 'like', '%' .$text_query. '%');
			}

			$teachers = $teachers->paginate(30);

			return View::make('teachers.annuaire', compact('teachers'), [ 'teachers' => $teachers->appends(Input::except('page')) ]);
		} 
		

else {

		$teachers = User::where('is_teacher', true)->whereNotIn('id', array($user_id))->orderBy('fullname', 'asc')->paginate(30);
		return View::make('teachers.annuaire', compact('teachers'));
	}

		

}



	public function profile($id)
	{
		$user = User::find($id);
		if ($user !== null) {
			return View::make('admin.user_profile', compact('user'));
		} else {
			return Redirect::route('admin_teachers');
		}
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.new_teacher');
		
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

					$destinationPath = 'uploads/profiles/teachers';

					$filename = $image->getClientOriginalName();
					$filename = strtolower($filename);
					$filename = str_ireplace(' ', '_', $filename);
					$filename = round(microtime(true)).'_'. $filename;

					$upload_success = $image->move($destinationPath, $filename);

					$user = User::create([
						
						'is_teacher' => 1,

						'fullname' => e(Input::get('fullname')),
						'gender' => e(Input::get('gender')),
						'username' => e(Input::get('username')),
						'password' => Hash::make(e(Input::get('password'))),

						'address' => e(Input::get('address')),
						'email' => e(Input::get('email')),
						'phone' => e(Input::get('phone')),

						'grade' => e(Input::get('grade')),
						'matricule' => e(Input::get('matricule')),
						'position' => e(Input::get('position')),
						'etat_civil' => e(Input::get('etat_civil')),


						'image' => $filename

					]);

				} else {

					$user = User::create([

						'is_teacher' => 1,

						'grade' => e(Input::get('grade')),
						'matricule' => e(Input::get('matricule')),
						'position' => e(Input::get('position')),
						'etat_civil' => e(Input::get('etat_civil')),

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
			return View::make('admin.update_teacher', compact('user'));
		} else {
			return Redirect::route('admin_teachers');
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
						unlink(public_path()."/uploads/profiles/teachers/".$user->image);
					}
					
					$image = Input::file('image');

					$destinationPath = 'uploads/profiles/teachers';

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

					$user->grade = e($inputs['grade']);
					$user->matricule = e($inputs['matricule']);
					$user->position = e($inputs['position']);
					$user->etat_civil = e($inputs['etat_civil']);



				} else {

					$user->fullname = e($inputs['fullname']);
					$user->gender = e($inputs['gender']);

					$user->address = e($inputs['address']);
					$user->email = e($inputs['email']);
					$user->phone = e($inputs['phone']);

					$user->grade = e($inputs['grade']);
					$user->matricule = e($inputs['matricule']);
					$user->position = e($inputs['position']);
					$user->etat_civil = e($inputs['etat_civil']);

				}

				
				$user->save();

				$path = Session::get('language');
				return Redirect::back()->withSuccess(Lang::get($path.'.Modified_successfully'));


		} else {
			return Redirect::route('admin_teachers');
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
			return Redirect::route('admin_teachers');
		}
	}


	public function destroy($id)
	{
		$user = User::find($id);

		if ($user !== null) {

			// remove CahierTexte
			$cahierTexte = CahierTexte::where('teacher_id', $user->id)->get();
			foreach ($cahierTexte as $txt) {
				$txt->teacher_id = 0;
				$txt->save();
			}

			// remove subjects from this emploi
			$emploi = Emploi::where('teacher_id', $user->id)->get();
			foreach ($emploi as $em) {
				$em->teacher_id = 0;
				$em->save();
			}

			// delete absences
			$absences = Absence::where('user_id', $user->id)->delete();

			// delete comments
			$comments = Comment::where('user_id', $user->id)->delete();

			// delete reports
			$report = Report::where('author_id', $user->id)->delete();

			// delete exams
			$exams = Exam::where('teacher_id', $user->id)->delete();

			// delete lessons
			$lessons = Lesson::where('teacher_id', $user->id)->delete();

			// delete messages
			$messages = Message::where('receiver_id', $user->id)->get();
			foreach ($messages as $message) {
				$message->delete();
			}

			$messages_2 = Message::where('sender_id', $user->id)->get();
			foreach ($messages_2 as $message_2) {
				$message_2->delete();
			}

			// delete marks
			$marks = Marks::where('teacher_id', $user->id)->delete();

			// remove form subjects
			$subjects = Subject::where('teacher_id', $user->id)->get();
			foreach ($subjects as $subject) {
				$subject->teacher_id = 0;
				$subject->save();
			}

			// remove form library
			$library = Library::where('user_id', $user->id)->get();
			foreach ($library as $l) {
				$l->user_id = 0;
				$l->save();
			}

			// delete image
	        if (!empty($user->image)) {
	            unlink(public_path()."/uploads/profiles/teachers/".$user->image);
	        }

			$user->delete();

			$path = Session::get('language');
			return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

		} 

		else {
			return Redirect::back();
		}
	}



	/*--------------------------------------------------------------------------*/


	public function subjects()
	{	
		
		$user_id = Auth::user()->id;

		$subjects = Subject::where('teacher_id', $user_id)->orderBy('id', 'desc')->paginate(15);

		$classes = TheClass::all();

		return View::make('teachers.subjects', compact('subjects', 'times', 'classes', 'parcour'));
	}


	public function subjects_store()
	{
		if (Request::ajax()){

	
			$inputs = Input::all();
			$validation = Validator::make($inputs, [
				'name'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 

			else {
				$parcours = implode(",", $inputs['parcours']);

				$class = Subject::create([

					'semestre' => e($inputs['semestre']),
					'name' => e($inputs['name']),
					'class_id' => e($inputs['class_id']),
					'teacher_id' => Auth::user()->id,
					'note' => e($inputs['note']),
					'times' => e($inputs['times']),
					'parcours' => $parcours

				]);

				return 'true';
			}

        }
	}


	public function subjects_update($id)
	{
		if (Request::ajax()){

			$inputs = Input::all();
			$validation = Validator::make($inputs, [
				'name'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 

			else {
				
				$subject = Subject::find($id);
				$parcours = implode(",", $inputs['parcours']);
				
				if ($subject->teacher_id == Auth::user()->id) {

					$subject->semestre = e($inputs['semestre']);
					$subject->name = e($inputs['name']);
					$subject->times = e($inputs['times']);
					$subject->class_id = e($inputs['class_id']);
					$subject->parcours;
					$subject->teacher_id = Auth::user()->id;
					$subject->note = e($inputs['note']);
					$subject->save();

					return 'true';
				}

				
			}

        }
	}


	public function subjects_destroy($id)
	{
		$subject = Subject::find($id);

		if ($subject !== null) {

			if ($subject->teacher_id == Auth::user()->id) {

				// remove subjects from this emploi
				$emploi = Emploi::where('subject_id', $subject->id)->get();
				foreach ($emploi as $em) {
					$em->subject_id = 0;
					$em->save();
				}

				// delete all marks of this subject
				$subjects = Marks::where('subject_id', $subject->id)->get();
				foreach ($subjects as $subject) {
					$subject->delete();
				}

				// delete all exams of this subject
				$exams = Exam::where('subject_id', $subject->id)->get();
				foreach ($exams as $exam) {
					$exam->delete();
				}

				// delete all lessons of this subject
				$lessons = Lesson::where('subject_id', $subject->id)->get();
				foreach ($lessons as $lesson) {

					// delete  file
					if (!empty($lesson->jointe)) {
						unlink(public_path()."/uploads/lessons/".$lesson->jointe);
					}

					$lesson->delete();
				}

				$subject->delete();

				$path = Session::get('language');
				return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

			} 

			else {
				return Redirect::route('home');
			}

		} 

		else {
			return Redirect::back();
		}


	}


	/*-------------------------------------------------------------*/


	public function admin_cahier_de_texte()
	{	
	
		$cahier_de_texte = CahierTexte::orderBy('id', 'desc')->paginate(15);

		return View::make('admin.cahier_de_texte', compact('cahier_de_texte'));
	}



	public function cahier_de_texte()
	{	
		
		$user_id = Auth::user()->id;

		$cahier_de_texte = CahierTexte::where('teacher_id', $user_id)->orderBy('id', 'desc')->paginate(15);

		$classes = TheClass::all();

		return View::make('teachers.cahier_de_texte', compact('cahier_de_texte','classes'));
	}


	public function cahier_de_texte_store()
	{
		if (Request::ajax()){

	
			$inputs = Input::all();
			$validation = Validator::make($inputs, []);
			if ($validation->fails()) {
				return 'false';
			} 

			else {
				$parcours = implode(",", $inputs['parcours']);

				$cahier_de_texte = CahierTexte::create([

					'the_date' => e($inputs['date']),
					'the_time' => e($inputs['time']),
					'salle' => e($inputs['salle']),
					'teacher_id' => Auth::user()->id,
					'class_id' => e($inputs['class_id']),
					'subject_id' => e($inputs['subject']),
					'tp' => e($inputs['tp']),
					'note' => e($inputs['note']),
					'magistrale' => e($inputs['magistrale']),
					'parcours' => $parcours

					

				]);

				return 'true';
			}

        }
	}

public function cahier_de_texte_edit($id)
	{
		$cahier_de_texte = CahierTexte::find($id);

		if ($cahier_de_texte !== null) {

			if ($cahier_de_texte->teacher_id == Auth::user()->id) {


				$user_id = Auth::user()->id;

				$classes = TheClass::all();

				return View::make('teachers.update_cahier_de_texte', compact('cahier_de_texte','classes'));

			} 

			else {
				return Redirect::route('home');
			}

		} 

		else {
			return Redirect::back();
		}




	}

	public function cahier_de_texte_update($id)
	{
		if (Request::ajax()){

			$inputs = Input::all();
			$validation = Validator::make($inputs, []);
			if ($validation->fails()) {
				return 'false';
			} 

			else {
				
				$cahier_de_texte = CahierTexte::find($id);

				$parcours = implode(",", $inputs['parcours']);

					$cahier_de_texte->the_date = e($inputs['date']);
					$cahier_de_texte->the_time = e($inputs['time']);
					$cahier_de_texte->salle = e($inputs['salle']);
					$cahier_de_texte->class_id = e($inputs['class_id']);
					$cahier_de_texte->parcours;
					$cahier_de_texte->subject_id = e($inputs['subject']);
					$cahier_de_texte->magistrale = e($inputs['magistrale']);
					$cahier_de_texte->tp = e($inputs['tp']);
					$cahier_de_texte->note = e($inputs['note']);
					$cahier_de_texte->save();


					return 'true';

				
			}

        }

 


	}

	public function cahier_de_texte_destroy($id)
	{
		$cahier_de_texte = CahierTexte::find($id);

		if ($cahier_de_texte !== null) {

			if ($cahier_de_texte->teacher_id == Auth::user()->id) {


				$cahier_de_texte->delete();

				$path = Session::get('language');
				return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

			} 

			else {
				return Redirect::route('home');
			}

		} 

		else {
			return Redirect::back();
		}


	}


	public function pedagogiques()
	{	
		
		$user_id = Auth::user()->id;

		$pedagogiques = Pedagogique::where('teacher_id', $user_id);

		$pedagogiques = $pedagogiques->whereRaw('DATE(date_end) >= CURDATE()')->orderBy('id', 'desc')->paginate(10);

		$classes = TheClass::all();

		return View::make('teachers.pedagogiques', compact('pedagogiques','classes'));



	}


	public function teacher_pedagogique_archives()
	{	
		
		$user_id = Auth::user()->id;

		$pedagogiques = Pedagogique::where('teacher_id', $user_id);

		$pedagogiques = $pedagogiques->whereRaw('DATE(date_end) <= CURDATE()')->orderBy('id', 'desc')->paginate(15);

		return View::make('teachers.pedagogique_archives', compact('pedagogiques'));
	}


	public function pedagogiques_store()
	{
		if (Request::ajax()){

	
			$inputs = Input::all();
			$validation = Validator::make($inputs, [
				'date_start'=>'required',
				'date_end'=>'required',
				//'grade'=>'required'
			]);
			if ($validation->fails()) {
				return 'false';
			} 

			else {

				$parcours = implode(",", $inputs['parcours']);
	
				$Pedagogique = Pedagogique::create([

					//'days' => e($inputs['days']),
					'date_start' => e($inputs['date_start']),
					'date_end' => e($inputs['date_end']),
					'hour_start' => e($inputs['hour_start']),
					'hour_end' => e($inputs['hour_end']),
					'teacher_id' => Auth::user()->id,
					'parcours' => $parcours,
					'class_id' => e($inputs['class_id']),
					'subject_id' => e($inputs['subject']),
					'times' => e($inputs['time']),
					'magistrale' => e($inputs['magistrale']),
					'tp' => e($inputs['tp']),
					'note' => e($inputs['note']),
					'grade' => e($inputs['grade'])
					


				]);	

				return 'true';
			}

        }
	}


	public function pedagogique_update($id)
	{
		if (Request::ajax()){

			$inputs = Input::all();
			$validation = Validator::make($inputs, [
				'date_start'=>'required',
				'date_end'=>'required',
				//'grade'=>'required'
			]);
			if ($validation->fails()) {
				return 'false';
			} 

			else {
				$pedagogique = Pedagogique::find($id);

			    $parcours = implode(",", $inputs['parcours']);

				if ($pedagogique->teacher_id == Auth::user()->id) {

					//$pedagogique->days = e($inputs['days']);
					$pedagogique->date_start = e($inputs['date_start']);
					$pedagogique->date_end = e($inputs['date_end']);
					$pedagogique->hour_start = e($inputs['hour_start']);
					$pedagogique->hour_end = e($inputs['hour_end']);
					$pedagogique->parcours = $parcours;
					$pedagogique->class_id = e($inputs['class_id']);
					$pedagogique->subject_id = e($inputs['subject']);
					$pedagogique->times = e($inputs['time']);
					$pedagogique->magistrale = e($inputs['magistrale']);
					$pedagogique->tp = e($inputs['tp']);
					$pedagogique->note = e($inputs['note']);
					//$pedagogique->grade = e($inputs['grade']);
					$pedagogique->save();

					return 'true';


				}

				
			}

        }
	}


	public function pedagogiques_destroy($id)
	{
		$pedagogique = Pedagogique::find($id);

		if ($pedagogique !== null) {

			if ($pedagogique->teacher_id == Auth::user()->id) {


				$pedagogique->delete();

				$path = Session::get('language');
				return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

			} 

			else {
				return Redirect::route('home');
			}

		} 

		else {
			return Redirect::back();
		}


	}


	/*----------------------------------------*/





	public function find_students()
	{	
		$inputs = Input::all();
		$text_query = e(Input::get('q'));

		if (!empty($text_query)) {
	
			$students = User::where('is_student', true);

			if(Input::has('q')) {
				$students->where('fullname', 'like', '%' .$text_query. '%')->orWhere('registration_num', $text_query);
			}

			$students = $students->paginate(15);

			return View::make('teachers.students', compact('students'), [ 'students' => $students->appends(Input::except('page')) ]);
		} 

		else {
			return View::make('teachers.students');
		}
	}


	public function annuaire_teacher_profile($id)
	{	
		$user = User::find($id);	
		if ($user !== null) {
			return View::make('teachers.user_profile', compact('user'));
		} else {
			return Redirect::route('t_annuaire_teachers');
		}
		
	}

	public function student_profile($id)
	{	
		$user = User::find($id);
		if ($user !== null) {
			return View::make('teachers.user_profile', compact('user'));
		} else {
			return Redirect::route('teacher_students');
		}
		
	}

	public function parent_profile($id)
	{	
		$user = User::find($id);
		if ($user !== null) {
			return View::make('teachers.user_profile', compact('user'));
		} else {
			return Redirect::route('teacher_students');
		}
		
	}

	public function report_student($id)
	{	
		$user = User::find($id);
		if ($user !== null) {
			return View::make('teachers.report', compact('user'));
		} else {
			return Redirect::route('teacher_students');
		}
		
	}

	public function report_store($id)
	{	

		if (Request::ajax()){

			$inputs = Input::all();
			$validation = Validator::make($inputs, ['copy_to_parent'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 

			else {

				$user_id = Auth::user()->id;
	
				$report = Report::create([

					'author_id' => $user_id,
					'to_parent' => e($inputs['copy_to_parent']),
					'report' => e($inputs['report']),
					'student_id' => e($id)

				]);

				return 'true';
			}

        }
		
	}


	// absence registration
	public function absences() {

		$user_id = Auth::user()->id;

		$absences = Absence::where('user_id', $user_id)->orderBy('id', 'desc')->paginate(15);

		return View::make('teachers.absences', compact('absences'));
	}

	public function absence_store() {

		$user_id = Auth::user()->id;

		if (Request::ajax()){

			$inputs = Input::all();
			$validation = Validator::make($inputs, ['date'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 

			else {
	
				$absence = Absence::create([

					'date' => e($inputs['date']),
					'note' => e($inputs['note']),
					'user_id' => $user_id

				]);

				return 'true';
			}

        }

	}


	public function exams()
	{
		$user_id = Auth::user()->id;

		$exams = Exam::where('teacher_id', $user_id)->orderBy('id', 'desc')->paginate(15);
		
		$subjects = $subjects = Subject::where('teacher_id', $user_id)->get();

		$classes_array = array();

		foreach ($subjects as $subject) {
			$classes_array[] = $subject->class_id;
		}

		$classes = TheClass::whereIn('id', $classes_array)->get();

		return View::make('teachers.exams', compact('exams', 'classes', 'subjects'));
	}



	public function exam_store()
	{
		$user_id = Auth::user()->id;

		if (Request::ajax()){

			$inputs = Input::all();
			$validation = Validator::make($inputs, ['class_id'=>'required', 'subject_id'=>'required', 'exam_date'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 

			else {
	
				$absence = Exam::create([

					'teacher_id' => $user_id,
					'class_id' => e($inputs['class_id']),
					'subject_id' => e($inputs['subject_id']),
					'exam_date' => e($inputs['exam_date']),
					'exam_time' => e($inputs['exam_time'])

				]);

				return 'true';
			}

        }
	}


	public function exam_destroy($id)
	{
		$exam = Exam::find($id);

		$exam->delete();

		$path = Session::get('language');
		return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));
	}




	public function marks()
	{
		$user_id = Auth::user()->id;

		$marks = Marks::where('teacher_id', $user_id)->orderBy('id', 'desc')->paginate(15);
		
		$subjects = $subjects = Subject::where('teacher_id', $user_id)->get();

		$classes_array = array();

		foreach ($subjects as $subject) {
			$classes_array[] = $subject->class_id;
		}

		$classes = TheClass::whereIn('id', $classes_array)->get();

		return View::make('teachers.marks', compact('classes', 'subjects', 'marks'));
	}



	public function mark_store()
	{
		

		if (Request::ajax()){

			$inputs = Input::all();
			
		

			$validation = Validator::make($inputs, ['subject_id'=>'required', 'class_id'=>'required', 'student_id'=>'required', 'mark'=>'required']);

			if ($validation->fails()) {
				return 'false';
			} 

			else {

				$user_id = Auth::user()->id;

				$mark = Marks::create([

					'teacher_id' => $user_id,
					'class_id' => e($inputs['class_id']),
					'subject_id' => e($inputs['subject_id']),
					'student_id' => e($inputs['student_id']),
					'mark' => e($inputs['mark']),
					'note' => e($inputs['note'])

				]);

				return 'true';
			}

			


        }
	}


	public function mark_destroy($id)
	{
		$mark = Marks::find($id);

		$mark->delete();

		$path = Session::get('language');
		return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));
	}




	/*------------------------------------------------------------------*/

	public function edit_profile()
	{
		$user_id = Auth::user()->id;

		$user = User::find($user_id);

		return View::make('teachers.edit_profile', compact('user'));

		
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
						unlink(public_path()."/uploads/profiles/teachers/".$user->image);
					}
					
					$image = Input::file('image');

					$destinationPath = 'uploads/profiles/teachers';

					$filename = $image->getClientOriginalName();
					$filename = strtolower($filename);
					$filename = str_ireplace(' ', '_', $filename);
					$filename = round(microtime(true)).'_'. $filename;

					$upload_success = $image->move($destinationPath, $filename);

					$user->address = e($inputs['address']);
					$user->email = e($inputs['email']);
					$user->phone = e($inputs['phone']);
					$user->image = $filename;

					$user->etat_civil = e($inputs['etat_civil']);



				} else {

					$user->address = e($inputs['address']);
					$user->email = e($inputs['email']);
					$user->phone = e($inputs['phone']);

					$user->etat_civil = e($inputs['etat_civil']);
					

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

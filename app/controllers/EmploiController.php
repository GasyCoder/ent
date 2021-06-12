<?php

class EmploiController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$classes = TheClass::all();
		return View::make('admin.emploi', compact('classes'));
	}


	public function teacher_emploi()
	{	
		$user_id = Auth::user()->id;


		$inputs = Input::all();
		$text_query = e(Input::get('q'));

		if (!empty($text_query)) {
	
			if(Input::has('q')) {
				$emploi = Emploi::where('teacher_id', $user_id)->where('date_start', $text_query);
			}	

			$emploi = $emploi->paginate(7);

			return View::make('teachers.emploi', compact('emploi'), [ 'emploi' => $emploi->appends(Input::except('page')) ]);
		} 

		else {
			
			//$emploi = Emploi::where('teacher_id', $user_id)->paginate(7);
			$emploi = Emploi::where('teacher_id', $user_id)->orderBy('the_day', 'date_start', 'desc')->paginate(7);
			return View::make('teachers.emploi', compact('emploi'));
		}

	}

	public function student_emploi()
	{	
		$class_id = Auth::user()->class_id;

		$parcour = Auth::user()->parcour;

		$inputs = Input::all();
		$text_query = e(Input::get('q'));

		if (!empty($text_query)) {
	
			if(Input::has('q')) {
				$emploi = Emploi::where('class_id', $class_id)->where('date_start', $text_query);
			}

			$emploi = $emploi->paginate(7);

			return View::make('students.emploi', compact('emploi', 'class_id', 'parcour'), [ 'emploi' => $emploi->appends(Input::except('page')) ]);
		} 

		else {
			
			$emploi = Emploi::where('class_id', $class_id)->orderBy('the_day', 'desc')->paginate(7);
			return View::make('students.emploi', compact('emploi', 'class_id', 'parcour'));
		}

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$classes = TheClass::all();
		$subjects = Subject::all();
		$teachers = User::where('is_teacher', true)->get();
		return View::make('admin.new_emploi', compact('classes', 'subjects', 'teachers'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Request::ajax()){

	
			$inputs = Input::all();
			$validation = Validator::make($inputs, [
				'days'=>'required',
				'subject_id'=>'required',
				'parcours'=>'required'

				]);

			if ($validation->fails()) {
				return 'false';
			} 

			else {


			$hour_start = array($inputs['hour_start']);
			$hour_end = array($inputs['hour_end']);
			$date_start = array($inputs['date_start']);
			$date_end = array($inputs['date_end']);


		
			$emploi_check_salle = Emploi::where('the_day', e($inputs['days']))->where('the_hour', e($inputs['hour_start']))->where('date_start', e($inputs['date_start']))->where('salle', e($inputs['salle']))->get();

			$emploi_check_teacher = Emploi::where('the_day', e($inputs['days']))->where('the_hour', e($inputs['hour_start']))->where('date_start', e($inputs['date_start']))->where('teacher_id', e($inputs['teacher']))->get();


			$emploi_check_classe = Emploi::where('the_day', e($inputs['days']))->where('the_hour', e($inputs['hour_start']))->where('date_start', e($inputs['date_start']))->where('class_id', e($inputs['class_id']))->get();


			$emploi_check_teacher2 = Emploi::where('the_day', e($inputs['days']))->where('teacher_id', e($inputs['teacher']))->where('date_start', e($inputs['date_start']))->where('end_hour', '>', $hour_start)->where('the_hour', '<', $hour_start)->get();


			$emploi_check_salle2 = Emploi::where('the_day', e($inputs['days']))->where('salle', e($inputs['salle']))->where('date_start', e($inputs['date_start']))->where('end_hour', '>', $hour_start)->where('the_hour', '<', $hour_start)->get();

			$emploi_check_classe2 = Emploi::where('the_day', e($inputs['days']))->where('class_id', e($inputs['class_id']))->where('date_start', e($inputs['date_start']))->where('end_hour', '>', $hour_start)->where('the_hour', '<', $hour_start)->get();

	

				if (count($emploi_check_salle) >= 1) {

					return 'occupee_salle';
				} 

				elseif (count($emploi_check_teacher) >= 1) {

					return 'occupee_teacher';
				}

				elseif (count($emploi_check_classe) >= 1) {

					return 'occupee_classe';
				}

				elseif (count($emploi_check_teacher2) >= 1) {

					return 'occupee_teacher_in_this_hour';
				
				} 


			elseif (count($emploi_check_salle2) >= 1) {

					return 'occupee_salle_in_this_hour';
				
				} 

			elseif (count($emploi_check_classe2) >= 1) {

					return 'occupee_classe_in_this_hour';
				
				} 


				elseif ($hour_start >= $hour_end) {	
					return 'false2';
				}

			

				else {	

					$parcours = implode(",", $inputs['parcours']);

					$Emploi = Emploi::create([

						'class_id' => e($inputs['class_id']),
						'subject_id' => e($inputs['subject_id']),
						'teacher_id' => e($inputs['teacher']),
						'salle' => e($inputs['salle']),
						'the_day' => e($inputs['days']),
						'the_hour' => e($inputs['hour_start']),
						'end_hour' => e($inputs['hour_end']),
						'parcours' => $parcours,

						'date_start' => e($inputs['date_start']),
						'date_end' => e($inputs['date_end'])


					]);

					return 'true';

				}


			}

        }
	}


public function update_emploi($id)
	{
		if (Request::ajax()){

	
			$inputs = Input::all();
			$validation = Validator::make($inputs, [
				'class_id'=>'required', 
				'days'=>'required',
				'subject_id'=>'required',
				'parcours'=>'required'

				]);

			if ($validation->fails()) {
				return 'false';
			} 

			else {


			$hour_start = array($inputs['hour_start']);
			$hour_end = array($inputs['hour_end']);

		
			$emploi_check_salle = Emploi::where('the_day', e($inputs['days']))->where('the_hour', e($inputs['hour_start']))->where('salle', e($inputs['salle']))->get();

			$emploi_check_teacher = Emploi::where('the_day', e($inputs['days']))->where('the_hour', e($inputs['hour_start']))->where('teacher_id', e($inputs['teacher']))->get();


			$emploi_check_classe = Emploi::where('the_day', e($inputs['days']))->where('the_hour', e($inputs['hour_start']))->where('class_id', e($inputs['class_id']))->get();


			$emploi_check_teacher2 = Emploi::where('the_day', e($inputs['days']))->where('teacher_id', e($inputs['teacher']))->where('end_hour', '>', $hour_start)->where('the_hour', '<', $hour_start)->get();


			$emploi_check_salle2 = Emploi::where('the_day', e($inputs['days']))->where('salle', e($inputs['salle']))->where('end_hour', '>', $hour_start)->where('the_hour', '<', $hour_start)->get();

			$emploi_check_classe2 = Emploi::where('the_day', e($inputs['days']))->where('class_id', e($inputs['class_id']))->where('end_hour', '>', $hour_start)->where('the_hour', '<', $hour_start)->get();

	

				if (count($emploi_check_salle) >= 1) {

					return 'occupee_salle';
				} 

				elseif (count($emploi_check_teacher) >= 1) {

					return 'occupee_teacher';
				}

				elseif (count($emploi_check_classe) >= 1) {

					return 'occupee_classe';
				}

				elseif (count($emploi_check_teacher2) >= 1) {

					return 'occupee_teacher_in_this_hour';
				
				} 


			elseif (count($emploi_check_salle2) >= 1) {

					return 'occupee_salle_in_this_hour';
				
				} 

			elseif (count($emploi_check_classe2) >= 1) {

					return 'occupee_classe_in_this_hour';
				
				} 


				elseif ($hour_start >= $hour_end) {
					return 'false2';
				}
				
			else {


					$parcours = implode(",", $inputs['parcours']);


					$Emploi = Emploi::find($id);

					$Emploi->class_id = e($inputs['class_id']);
					$Emploi->subject_id = e($inputs['subject_id']);
					$Emploi->teacher_id = e($inputs['teacher']);
					$Emploi->salle = e($inputs['salle']);
					$Emploi->the_day = e($inputs['days']);
					$Emploi->the_hour = e($inputs['hour_start']);
					$Emploi->end_hour = e($inputs['hour_end']);
					$Emploi->parcours =  $parcours;
					$Emploi->date_start = e($inputs['date_start']);
					$Emploi->date_end = e($inputs['date_end']);
					$Emploi->save();

					return 'true';

				


			}

        }
	}

}

	public function edit($id)
	{
		$emploi = Emploi::find($id);

		if ($emploi !== null) {

			if (Auth::user()->is_admin) {

					$classes = TheClass::all();
					$subjects = Subject::all();
					$teachers = User::where('is_teacher', true)->get();
					return View::make('admin.update_emploi', compact('emploi', 'classes', 'subjects', 'teachers'));

			} else {
				return Redirect::route('home');
			}

		} else {
			return Redirect::route('home');
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
		$emploi = Emploi::find($id);

		if ($emploi !== null) {

			if (Auth::user()->is_admin) {

					$emploi->delete();

					$path = Session::get('language');
					return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

			} else {
				return Redirect::route('emploi_du_temps');
			}

		} else {
			return Redirect::route('emploi_du_temps');
		}
	}


}

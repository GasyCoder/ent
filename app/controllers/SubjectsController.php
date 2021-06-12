<?php

class SubjectsController extends BaseController {

	/**
	 * Display a listing of the resource.	
	 *	
	 * @return Response
	 */
	public function index()	
	{
		$subjects = Subject::orderBy('id', 'desc')->paginate(15);
		$classes = TheClass::all();
		$teachers = User::where('is_teacher', true)->get();

		return View::make('admin.subjects', compact('subjects', 'semestre', 'times', 'classes', 'parcour', 'teachers'));
	}


	
	public function store()
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
					'times' => e($inputs['times']),
					'class_id' => e($inputs['class_id']),
					'parcours' => $parcours,
					'teacher_id' => e($inputs['teacher_id']),
					'note' => e($inputs['note'])
					

				]);

				return 'true';
			}

        }
	}


	


	public function update($id)
	{
		if (Request::ajax()){

			$inputs = Input::all();
			$validation = Validator::make($inputs, [
				'name'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 

			else {
				
				$class = Subject::find($id);
				$parcours = implode(",", $inputs['parcours']);
				
				$class->semestre = e($inputs['semestre']);
				$class->name = e($inputs['name']);
				$class->times = e($inputs['times']);
				$class->class_id = e($inputs['class_id']);
				$class->parcours;
				$class->teacher_id = e($inputs['teacher_id']);
				$class->note = e($inputs['note']);
				$class->save();

				return 'true';
			}

        }
	}


	
	public function destroy($id)
	{
		$subject = Subject::find($id);

		if ($subject !== null) {

			// remove subjects from this emploi
			$emploi = Emploi::where('subject_id', $subject->id)->get();
			foreach ($emploi as $em) {
				$em->subject_id = 0;
				$em->save();
			}

			// remove subjects from this txt
				$cahier_de_texte = CahierTexte::where('subject_id', $subject->id)->get();
				foreach ($cahier_de_texte as $txt) {
					$txt->subject_id = 0;
					$txt->save();
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
					$filename = public_path()."/uploads/lessons/".$lesson->jointe);
				}

				\File::delete($lesson);

			}


			$subject->delete();

			$path = Session::get('language');
			return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

		} 

		else {
			return Redirect::back();
		}


	}


}

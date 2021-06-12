<?php

class TransportController extends BaseController {

	
	public function index()
	{
		$classes = TheClass::all();
		return View::make('admin.transport', compact('classes'));
	}


	public function store()
	{
		if (Request::ajax()){

	
			$inputs = Input::all();
			$validation = Validator::make($inputs, ['class_id'=>'required', 'days'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 

			else {
	
				$transport = Transport::create([

					'day_id' => e($inputs['days']),
					'class_id' => e($inputs['class_id']),
					'time_start' => e($inputs['time_start']),
					'time_return' => e($inputs['time_return'])

				]);

				return 'true';
			}

        }
	}


	
	public function student_transport()
	{
		$class_id = Auth::user()->class_id;
		$transport = Transport::where('class_id', $class_id)->orderBy('id', 'desc')->paginate(15);
		return View::make('students.transport', compact('transport'));
	}


	public function destroy($id)
	{
		$transport = Transport::find($id);

		if ($transport !== null) {

			if (Auth::user()->is_admin) {

					$transport->delete();

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

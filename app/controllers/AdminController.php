<?php

class AdminController extends BaseController {

	protected $rules = [

			'email'=>'email',
			'pagination'=>'integer',
			'payment_tax'=>'integer',
			'news'=>'max:400'

	];

	public function index()
	{
		$students = User::where('is_student', true)->get();
		$teachers = User::where('is_teacher', true)->get();
		$managers = User::where('is_manager', true)->get();
		$articles = Article::all();
		$pages = Page::all();

		return View::make('users.index', compact('students', 'teachers', 'managers', 'articles', 'pages'));
	}


		public function pedagogiques()
	{	
		

	//	$pedagogiques = Pedagogique::whereRaw('DATE(date_end) >= CURDATE()')->orderBy('id', 'desc')->paginate(15);

		$pedagogiques = Pedagogique::orderBy('id', 'desc')->paginate(15);

		return View::make('admin.pedagogiques', compact('pedagogiques'));
	}


	public function absences()
	{

		$absences = Absence::orderBy('id', 'desc')->paginate(15);
		$classes = TheClass::all();
		return View::make('admin.absences', compact('absences', 'classes'));
	}

	public function absence_store()
	{

		if (Request::ajax()){

			$inputs = Input::all();
			$validation = Validator::make($inputs, ['date'=>'required', 'student_id'=>'required']);
			if ($validation->fails()) {
				return 'false';
			}

			else {

				$user_id = $inputs['student_id'];

//----------> send absences reports by email

				$control = Control::find(1);

				$student = User::find($user_id);

				$student_email = $student->email;
				$student_name = $student->fullname;

				if (!empty($student->guardian_id)) {
					$guardian_email = $student->parent->email;
					$guardian_name = $student->parent->fullname;
				} else {
					$guardian_email = '';
					$guardian_name = '';
				}



				$school_email = $control->email;
				$school_name = $control->school_name;

				$data = [
	           		'note' => e($inputs['note']),
	           		'student_name' => $student_name,
	           		'date' => e($inputs['date'])
				];

if (!empty($student_email)) {
				// to student
				Mail::send('emails.absences', $data, function($message) use ($student_email, $student_name, $school_email, $school_name) {
				    $message->to($student_email, $student_name)->subject('new absence report');
				    $message->from($school_email, $school_name);
				});
}


if (!empty($guardian_email)) {
				// to guardian
				Mail::send('emails.absences', $data, function($message) use ($guardian_email, $guardian_name, $school_email, $school_name) {
				    $message->to($guardian_email, $guardian_name)->subject('new absence report');
				    $message->from($school_email, $school_name);
				});
}



//------->

				$absence = Absence::create([

					'date' => e($inputs['date']),
					'note' => e($inputs['note']),
					'admin_read_stut' => 0,
					'user_id' => $user_id

				]);

				return 'true';
			}

        }
	}


	public function reports()
	{
		$reports = Report::orderBy('id', 'desc')->paginate(15);

		return View::make('admin.reports', compact('reports'));
	}


	public function settings()
	{
		$control = Control::find(1);
		$user_id = Auth::user()->id;
		$user = User::find($user_id);
		$slide = DB::table('slide')->where('id', '1')->first();

		if (!Auth::user()->is_manager) {
			return View::make('admin.settings', compact('control', 'user', 'slide'));
		} else {
			return Redirect::route('panel.admin');
		}


	}

	public function settings_update()
	{

		$control = Control::find(1);
		$slide = DB::table('slide')->where('id', '1')->first();

		$inputs = Input::all();

			$validation = Validator::make($inputs, $this->rules);

			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);

			} else {

				$control->school_name = e($inputs['school_name']);
				$control->email = e($inputs['email']);
				$control->phone = e($inputs['phone']);
				$control->address = e($inputs['address']);

				$control->facebook = e($inputs['facebook']);
				$control->twitter = e($inputs['twitter']);
				$control->youtube = e($inputs['youtube']);
				$control->google_plus = e($inputs['google_plus']);

				$control->paginate = e($inputs['pagination']);

				$control->description = e($inputs['description']);
				$control->keywords = e($inputs['keywords']);
				$control->news = e($inputs['news']);

				$control->closing_msg = e($inputs['closing_msg']);
				$control->close_site = e($inputs['close_site']);

				$control->library_apv = e($inputs['library_apv']);
				$control->marquee_rtl = e($inputs['marquee_rtl']);
				$control->slide = e($inputs['slide']);

				$control->payment_tax = e($inputs['payment_tax']);
				$control->payment_unit = e($inputs['payment_unit']);

				$control->save();


				$slide = DB::table('slide')->where('id', 1)->update(array('img_1' => e($inputs['img_1']), 'img_2' => e($inputs['img_2']), 'img_3' => e($inputs['img_3']), 'url_1' => e($inputs['url_1']), 'url_2' => e($inputs['url_2']), 'url_3' => e($inputs['url_3'])));


				$path = Session::get('language');
				return Redirect::back()->withSuccess(Lang::get($path.'.Modified_successfully'));
			}
	}





	public function update_admin()
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
						unlink(public_path()."/uploads/profiles/".$user->image);
					}

					$image = Input::file('image');

					$destinationPath = 'uploads/profiles';

					$filename = $image->getClientOriginalName();
					$filename = strtolower($filename);
					$filename = str_ireplace(' ', '_', $filename);
					$filename = round(microtime(true)).'_'. $filename;

					$upload_success = $image->move($destinationPath, $filename);


					$user->email = e($inputs['email']);
					$user->image = $filename;


				} else {
					$user->email = e($inputs['email']);
				}


				$user->save();

				$path = Session::get('language');
				return Redirect::back()->withSuccess(Lang::get($path.'.Modified_successfully'));


		}

	}


	public function admin_password()
	{

		$path = Session::get('language');

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

				return Redirect::back()->withSuccess(Lang::get($path.'.Information_modified'));

			}

			else {

				return Redirect::back()->withError(Lang::get($path.'.password_error'));

			}


		}


	}


/*------------------ payments ------------------*/

	public function payments()
	{
		$payments = Payments::orderBy('id', 'desc')->paginate(15);
		$classes = TheClass::all();
		return View::make('admin.payments', compact('payments', 'classes'));
	}


	public function payments_store()
	{
		if (Request::ajax()){

			$inputs = Input::all();
			$validation = Validator::make($inputs, [
				'date'=>'required',
				'student_id'=>'required',
				'Payment_Title'=>'required',
				'Payment_Trance'=>'required',
				'amount'=>'required'
			]);

			if ($validation->fails()) {
				return 'false';
			}

			else {

				$payment_index = round(microtime(true));

				$payments = Payments::create([

					'title' => e($inputs['Payment_Title']),
					'trance' => e($inputs['Payment_Trance']),
					'student_id' => e($inputs['student_id']),
					'payment_amount' => e($inputs['amount']),
					'payment_status' => e($inputs['paymentStatus']),
					'payment_date' => e($inputs['date']),
					'payment_index' => $payment_index


				]);

				return 'true';
			}

        }

	}

	public function payments_update($id)
	{
		if (Request::ajax()){

		$inputs = Input::all();
		$validation = Validator::make($inputs, ['date'=>'required', 'student_id'=>'required', 'Payment_Title'=>'required', 'Payment_Trance'=>'required', 'amount'=>'required']);
			if ($validation->fails()) {
				return 'false';
			}

			else {
				$payment = Payments::find($id);

				$payment->title = e($inputs['Payment_Title']);
				$payment->trance = e($inputs['Payment_Trance']);
				$payment->student_id = e($inputs['student_id']);
				$payment->payment_amount = e($inputs['amount']);
				$payment->payment_date = e($inputs['date']);
				$payment->payment_status = e($inputs['paymentStatus']);
				$payment->save();

				return 'true';
			}

        }
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
			return View::make('admin.payment_invoice', compact('payment', 'tax', 'total', 'control'));
		}

		else {
			return Redirect::back('admin_payments');
		}

	}

	public function payments_destroy($id)
	{
		$payment = Payments::find($id);

		if ($payment !== null) {

			$payment->delete();

			$path = Session::get('language');
			return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

		}

		else {
			return Redirect::back('admin_payments');
		}

	}





}

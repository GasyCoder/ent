<?php

class UsersController extends BaseController {

	protected $layouts = 'layouts.master';

	protected $user_rules = [

			'fullname'=>'required',
			'class'=>'required',
			'username'=>'required|min:3|unique:users',
			'email'=>'email|unique:users',
			'password'=>'required|min:4',
			'password_confirm'=>'required|same:password'

	];

	protected $file_rules = [

			'csv_file'=>'required'

	];

	public function login()
	{
		return View::make('users.login');
	}

	public function logout() {

		Auth::logout();
		return Redirect::route('home');

	}


	public function users_emploi() {

		$inputs = Input::all();
		$text_query = e(Input::get('q'));

		if (!empty($text_query)) {
	
			if(Input::has('q')) {
				$students = emploiUsers::where('fullname', 'like', '%' .$text_query. '%')->orWhere('registration_num', $text_query);
			}

			$students = $students->paginate(20);

			return View::make('admin.users_emploi', compact('students'), [ 'students' => $students->appends(Input::except('page')) ]);
		} 

		else {
			
			$students = emploiUsers::orderBy('fullname', 'asc')->paginate(20);
			return View::make('admin.users_emploi', compact('students'));
		}


	}

	public function users_emploi_export() {


		$table = emploiUsers::all();

	    $filename = public_path().'/uploads/emploi/' . strtotime('now') . '.csv';

	    $handle = fopen($filename, 'w+');

	    fputcsv($handle, array('fullname', 'class', 'registration_num', 'parcour', 'mention', 'admission', 'birthday', 'address', 'email', 'phone'), $delimiter=';');

	    foreach($table as $row) {
	        fputcsv($handle, array($row['fullname'], $row['class'], $row['registration_num'], $row['parcour'], $row['mention'], $row['admission'], $row['birthday'], $row['address'], $row['email'], $row['phone']), $delimiter=';');
	    }

	    fclose($handle);

/*
	    $headers = array(
	        'Content-Type'        => 'application/vnd.ms-excel; charset=utf-8',
		    'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
		    'Content-Disposition' => 'attachment; filename=abc.csv',
		    'Expires'             => '0',
	    );

	  return Response::download($filename, public_path().'/uploads/emploi/' . strtotime('now') . '.csv', $headers);
*/

	    return Redirect::back()->with('download', ''. strtotime('now') . '.csv');

	  


	}


	public function users_emploi_store() {

		

		$inputs = Input::all();

			$validation = Validator::make($inputs, $this->file_rules);

			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);
			} 

			else {

				if (Input::hasFile('csv_file')) {

					$extension = Input::file('csv_file')->getClientOriginalExtension();

					if ($extension == "csv" OR $extension == "CSV") {

						$file = Input::file('csv_file')->getRealPath();
					
						//$csvFile = public_path().'/uploads/emploi/CSV_sample.csv';

						function csv_to_array($filename='', $delimiter=';')
	                    {
	                        if(!file_exists($filename) || !is_readable($filename))
	                            return FALSE;
	                     
	                        $header = NULL;
	                        $emploi = array();
	                        if (($handle = fopen($filename, 'r')) !== FALSE)
	                        {
	                            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
	                            {
	                                if(!$header)
	                                    $header = $row;
	                                else
	                                    $emploi[] = array_combine($header, $row);
	                            }
	                            fclose($handle);
	                        }
	                        return $emploi;
	                    }

			          	$areas = csv_to_array($file);

			         	DB::table('users_emploi_fste')->insert($areas);

				        $path = Session::get('language');
						return Redirect::back()->with('success', Lang::get($path.'.users_import_success'));
						
					} else {
						return Redirect::back();
					}


				}

			}
		


	}




	public function emploi_delete($id)
	{
		$user = emploiUsers::find($id);

		if ($user !== null) {

			$user->delete();

			$path = Session::get('language');
			return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

		} 

		else {
			return Redirect::back();
		}


	}



	public function register() {

		$classes = TheClass::all();
		return View::make('users.register', compact('classes'));

	}



	public function register_store() {

			$inputs = Input::all();

			$validation = Validator::make($inputs, $this->user_rules); 

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
						'admission' => e(Input::get('admission')),


						'fullname' => e(Input::get('fullname')),
						'gender' => e(Input::get('gender')),
						'username' => e(Input::get('username')),
						'password' => Hash::make(e(Input::get('password'))),

						'birthday' => e(Input::get('birthday')),
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
						'admission' => e(Input::get('admission')),


						'fullname' => e(Input::get('fullname')),
						'gender' => e(Input::get('gender')),
						'username' => e(Input::get('username')),
						'password' => Hash::make(e(Input::get('password'))),

						'birthday' => e(Input::get('birthday')),
						'address' => e(Input::get('address')),
						'email' => e(Input::get('email')),
						'phone' => e(Input::get('phone'))
					]);

				}

				
				$user->save();

				$path = Session::get('language');
				return Redirect::route('users.login')->with('success', Lang::get($path.'.register_with_success'));
			}

	}


	public function check()
	{
		$inputs = Input::all();


		if (Input::get('remember')) {
			$remember = true;
		} else { $remember = false; }

		$username = e($inputs['username']);
		$password = e($inputs['password']);

		$validation = Validator::make($inputs, ['username'=>'required', 'password'=>'required']);

		if ($validation->fails()) {

			return Redirect::back()->withErrors($validation);

		} else {

			if (Auth::attempt(['username'=>$username, 'password'=>$password], $remember)) {

				Auth::attempt(['username'=>$username, 'password'=>$password], $remember);

				if (Auth::check()) {

					if(Auth::user()->is_admin) {
						return Redirect::route('panel.admin');
					}
					elseif(Auth::user()->is_student) {
						return Redirect::route('student_panel');
					}
					elseif(Auth::user()->is_teacher) {
						return Redirect::route('teacher_panel');
					}
					elseif(Auth::user()->is_parent) {
						return Redirect::route('parent_panel');
					} 
					else {
						return Redirect::route('home');
					}
					
					
				}
				
				

			} else {

				$path = Session::get('language');
				return Redirect::back()->with('error', Lang::get($path.'.username_or_password_error'));


			}
		}

	}




}

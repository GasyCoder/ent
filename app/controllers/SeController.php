<?php

class SeController extends BaseController {

	protected $layouts = 'layouts.master';

	/*protected $user_rules = [

			'element_c'=>'required',
			'class'=>'required',
			'username'=>'required|min:6|unique:users',
			'email'=>'email|unique:users',
			'password'=>'required|min:8',
			'password_confirm'=>'required|same:password'

	];*/




	protected $file_rules = [

			'csv_file'=>'required'

	];




	public function data_users() {	

		$inputs = Input::all();
		$text_query = e(Input::get('q'));

		if (!empty($text_query)) {
	
			if(Input::has('q')) {
				$teachers = UsersData::where('fullname', 'like', '%' .$text_query. '%')->orWhere('registration_num', $text_query);
			}

			$teachers = $teachers->paginate(300);

			return View::make('admin.data_users', compact('teachers'), [ 'teachers' => $teachers->appends(Input::except('page')) ]);
		} 

		else {
			
			$teachers = UsersData::orderBy('matricule_t', 'asc')->paginate(300);
			return View::make('admin.data_users', compact('teachers'));
		}

	}

	public function users_data_s_export() {


		$table = UsersData::all();

	    $filename = public_path().'/uploads/data_s/' . strtotime('now') . '.csv';

	    $handle = fopen($filename, 'w+');

	    fputcsv($handle, array('element_c', 'credit_ec', 'code_ec', 'unite_e', 'credit_t', 'matricule_t', 'semestre'), $delimiter=';');

	    foreach($table as $row) {
	        fputcsv($handle, array($row['element_c'], $row['credit_ec'], $row['code_ec'], $row['unite_e'], $row['credit_t'], $row['matricule_t'], $row['semestre']), $delimiter=';');
	    }

	    fclose($handle);

/*
	    $headers = array(
	        'Content-Type'        => 'application/vnd.ms-excel; charset=utf-8',
		    'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
		    'Content-Disposition' => 'attachment; filename=abc.csv',
		    'Expires'             => '0',
	    );

	  return Response::download($filename, public_path().'/uploads/data/' . strtotime('now') . '.csv', $headers);
*/

	    return Redirect::back()->with('download', ''. strtotime('now') . '.csv');

	  


	}


	public function users_data_s_store() {

		

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
					
						//$csvFile = public_path().'/uploads/data/CSV_sample.csv';

						function csv_to_array($filename='', $delimiter=';')
	                    {
	                        if(!file_exists($filename) || !is_readable($filename))
	                            return FALSE;
	                     
	                        $header = NULL;
	                        $data = array();
	                        if (($handle = fopen($filename, 'r')) !== FALSE)
	                        {
	                            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
	                            {
	                                if(!$header)
	                                    $header = $row;
	                                else
	                                    $data[] = array_combine($header, $row);
	                            }
	                            fclose($handle);
	                        }
	                        return $data;
	                    }

			          	$areas = csv_to_array($file);

			         	DB::table('data_users_fste')->insert($areas);

				        $path = Session::get('language');
						return Redirect::back()->with('success', Lang::get($path.'.users_import_success'));
						
					} else {
						return Redirect::back();
					}


				}

			}
		


	}



	public function data_s_delete($id)
	{
		$user = UsersData::find($id);

		if ($user !== null) {

			$user->delete();

			$path = Session::get('language');
			return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

		} 

		else {
			return Redirect::back();
		}


	}



	public function teacher_register() {

		$subjects = Subject::all();
		return View::make('admin.register', compact('subjects'));

	}



	public function teacher_register_store() {

			$inputs = Input::all();

			$validation = Validator::make($inputs, [
				'element_c'=>'']);

			if ($validation->fails()) {

				return Redirect::back()->withInput()->withErrors($validation);

			} 
			else {
		
					$user = User::create([

						'element_c' => e(Input::get('element_c')),
						'credit_ec' => e(Input::get('credit_ec')),
						'code_ec' => e(Input::get('code_ec')),
						'unite_e' => e(Input::get('unite_e')),
						'credit_t' => e(Input::get('credit_t')),
						'matricule_t' => e(Input::get('matricule_t'))
						//'gender' => e(Input::get('gender')),
						//'username' => e(Input::get('username')),
						//'password' => Hash::make(e(Input::get('password'))),

					
					]);

			$user->save();

				$path = Session::get('language');
				return Redirect::back()->with('success', Lang::get($path.'.success_added'));


			}
	}



	/*public function check()
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

	}*/




}

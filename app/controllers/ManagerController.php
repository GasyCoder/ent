<?php

class ManagerController extends BaseController {


	protected $rules = [

			'fullname'=>'required',
			'username'=>'required|min:3|unique:users',
			'email'=>'email|unique:users',
			'password'=>'required|min:4',
			'password_confirm'=>'required|same:password'

	];

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$managers = User::where('is_manager', true)->orderBy('fullname', 'asc')->paginate(15);
		
		if (!Auth::user()->is_manager) {
			return View::make('admin.managers', compact('managers'));
		} else {
			return Redirect::route('panel.admin');
		}
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.new_manager');
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

					$destinationPath = 'uploads/profiles/managers';

					$filename = $image->getClientOriginalName();
					$filename = strtolower($filename);
					$filename = str_ireplace(' ', '_', $filename);
					$filename = round(microtime(true)).'_'. $filename;

					$upload_success = $image->move($destinationPath, $filename);

					$user = User::create([
		
						'is_manager' => 1,
						'is_admin' => 1,

						'fullname' => e(Input::get('fullname')),
						'gender' => e(Input::get('gender')),
						'username' => e(Input::get('username')),
						'password' => Hash::make(e(Input::get('password'))),

						'email' => e(Input::get('email')),
						'phone' => e(Input::get('phone')),
						'image' => $filename
					]);

				} else {

					$user = User::create([
						
						'is_manager' => 1,
						'is_admin' => 1,
						

						'fullname' => e(Input::get('fullname')),
						'gender' => e(Input::get('gender')),
						'username' => e(Input::get('username')),
						'password' => Hash::make(e(Input::get('password'))),

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
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
			return View::make('admin.update_manager', compact('user'));
		} else {
			return Redirect::route('home');
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
						unlink(public_path()."/uploads/profiles/managers/".$user->image);
					}
					
					$image = Input::file('image');

					$destinationPath = 'uploads/profiles/managers';

					$filename = $image->getClientOriginalName();
					$filename = strtolower($filename);
					$filename = str_ireplace(' ', '_', $filename);
					$filename = round(microtime(true)).'_'. $filename;

					$upload_success = $image->move($destinationPath, $filename);

					$user->fullname = e($inputs['fullname']);
					$user->gender = e($inputs['gender']);

					$user->email = e($inputs['email']);
					$user->phone = e($inputs['phone']);
					$user->image = $filename;


				} else {

					$user->fullname = e($inputs['fullname']);
					$user->gender = e($inputs['gender']);

					$user->email = e($inputs['email']);
					$user->phone = e($inputs['phone']);

				}

				
				$user->save();

				$path = Session::get('language');
				return Redirect::back()->withSuccess(Lang::get($path.'.Modified_successfully'));


		} else {
			return Redirect::route('admin_managers');
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
			return Redirect::route('admin_managers');
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
	            unlink(public_path()."/uploads/profiles/managers/".$user->image);
	        }


	        // remove form library
			$library = Library::where('user_id', $user->id)->get();
			foreach ($library as $l) {
				$l->user_id = 0;
				$l->save();
			}

			$user->delete();

			$path = Session::get('language');
			return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));

		} 

		else {
			return Redirect::back();
		}


	}


/*----------------------------------------------------------------------------*/

	public function edit_profile()
	{
		$user_id = Auth::user()->id;

		$user = User::find($user_id);

		return View::make('admin.edit_profile', compact('user'));

		
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
						unlink(public_path()."/uploads/profiles/managers/".$user->image);
					}
					
					$image = Input::file('image');

					$destinationPath = 'uploads/profiles/managers';

					$filename = $image->getClientOriginalName();
					$filename = strtolower($filename);
					$filename = str_ireplace(' ', '_', $filename);
					$filename = round(microtime(true)).'_'. $filename;

					$upload_success = $image->move($destinationPath, $filename);

					$user->email = e($inputs['email']);
					$user->phone = e($inputs['phone']);
					$user->image = $filename;

				} else {

					$user->email = e($inputs['email']);
					$user->phone = e($inputs['phone']);

				}

				
				$user->save();

				$path = Session::get('language');
				return Redirect::back()->withSuccess(Lang::get($path.'.Modified_successfully'));


		}

		
	}


	public function manager_update_password()
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

	


}

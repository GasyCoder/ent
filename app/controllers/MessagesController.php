<?php

class MessagesController extends BaseController {


	protected $rules = [

			'file[]'=>'mimes:doc,docx,ppt,pptx,pdf,rar,zip',
			'subject'=>'required', 
			'message'=>'required'

	];

	public function incoming()
	{
		
		// delete messages
		$del_msgs = Message::where('receiver_statu', 1)->where('sender_statu', 1)->get();
		foreach ($del_msgs as $del_msg) {
			$del_msg->delete();

			// delete  file
			if (!empty($del_msg->file_path)) {

				$one_files = explode(",", $del_msg->file_path);

				foreach ($one_files as $on) {
					unlink(public_path()."/uploads/files_messages/".$on);
				}
			}
		}

		$user_id = Auth::user()->id;

		$auth_user = User::find($user_id);

		$messages = Message::where('receiver_id', $user_id)->where('receiver_statu', 0)->orderBy('id', 'desc')->paginate(15);

		return View::make('messages.incoming', compact('messages', 'auth_user'));

	}

	public function outgoing()
	{
		// delete messages
		$del_msgs = Message::where('receiver_statu', 1)->where('sender_statu', 1)->get();
		foreach ($del_msgs as $del_msg) {
			$del_msg->delete();

			// delete  file
			if (!empty($del_msg->file_path)) {
				
				$one_files = explode(",", $del_msg->file_path);

				foreach ($one_files as $on) {
					unlink(public_path()."/uploads/files_messages/".$on);
				}
				
			}
			
		}

		$user_id = Auth::user()->id;

		$auth_user = User::find($user_id);


		$send_messages = Message::where('sender_id', $user_id)->where('sender_statu', 0)->orderBy('id', 'desc')->paginate(15);

		return View::make('messages.outgoing', compact('send_messages', 'auth_user'));

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{	
		$user_id = Auth::user()->id;
		$auth_user = User::find($user_id);

		$user = User::find($id);

		if ($user !== null) {

			return View::make('messages.create', compact('user', 'auth_user'));

		} else {

			return Redirect::route('home');

		}

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id)
	{
		
		$user_id = Auth::user()->id;

		$inputs = Input::all();

			$validation = Validator::make($inputs, $this->rules);

			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);
			} 

			else {


				if (Input::hasFile('file')) {


$files = Input::file('file');
					$files_array = array();


if (count($files_array) > 6) {
	return Redirect::back()->withInput()->with('error', 'maximum 6 fichiers');
}


					foreach($files as $file) {


						$path = 'uploads/files_messages/';

						$filename = $file->getClientOriginalName();
						$filename = strtolower($filename);
						$filename = str_ireplace(' ', '_', $filename);

						$new_name = round(microtime(true)).'_'. $filename;

						$upload_file = $file->move($path, $new_name);


						$files_array[] = 	$new_name;
						

					}

				
					$all_files = implode(",", $files_array);


					$message = Message::create([

					'sender_id' => $user_id,
					'receiver_id' => $id,
					'subject' => e($inputs['subject']),
					'message' => e($inputs['message']),
					'read' => 0,
					'file_path'=> $all_files

					]);

					$message->save();

					$path = Session::get('language');
					return Redirect::back()->with('success', Lang::get($path.'.send_successfully'));

				} else {

					$message = Message::create([

					'sender_id' => $user_id,
					'receiver_id' => $id,
					'subject' => e($inputs['subject']),
					'message' => e($inputs['message']),
					'read' => 0

					]);

					$message->save();

					$path = Session::get('language');
					return Redirect::back()->with('success', Lang::get($path.'.send_successfully'));
				}
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
		$user_id = Auth::user()->id;

		$message = Message::find($id);

		if ($message !== null) {

			if ($message->sender_id == $user_id) {
				
				$message->sender_statu = 1;
				$message->save();

				return Redirect::back();

			}

			elseif ($message->receiver_id == $user_id) {
				
				$message->receiver_statu = 1;
				$message->save();
				
				return Redirect::back();

			} 

			else {
				return Redirect::back();
			}

		} else {

			return Redirect::route('home');

		}
	}


}

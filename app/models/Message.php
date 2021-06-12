<?php

class Message extends Eloquent {

	protected $fillable = [
			'sender_id', 'receiver_id', 'subject', 'message', 'read', 'file_path'
	];

	protected $table = 'messages_fste';


	public function getSender()
	{
		return $this->belongsTo('User', 'sender_id');
	}

	public function getRecevier()
	{
		return $this->belongsTo('User', 'receiver_id');
	}

	
}
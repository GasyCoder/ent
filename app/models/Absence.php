<?php

class Absence extends Eloquent {
	

	protected $guarded = ['id', 'created_at'];

	protected $table = 'absences_fste';


	public function user()	
	{
	    return $this->belongsTo('User', 'user_id');
	}




}
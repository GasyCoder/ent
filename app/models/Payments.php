<?php

class Payments extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'payments_fste';
	
	public function student()
	{
	    return $this->belongsTo('User', 'student_id');
	}

}
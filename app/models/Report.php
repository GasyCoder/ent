<?php

class Report extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'reports_fste';


	public function author()
	{
	    return $this->belongsTo('User', 'author_id');
	}

	public function stuReport()
	{
	    return $this->belongsTo('User', 'student_id');
	}

	
}
<?php

class Subject extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'subjects_fste';


	public function theclass()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}


	public function teacher()
	{
	    return $this->belongsTo('User');
	}

		public function Tsubject()
	{
	    return $this->belongsTo('Subject', 'subject_id');
	}

}
<?php

class Pedagogique extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'pedagogiques_fste';	


	public function Tclass()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}

	public function Tday()
	{
	    return $this->belongsTo('Days', 'days');
	}

	public function Tsubject()
	{
	    return $this->belongsTo('Subject', 'subject_id');
	}

		public function TheTeacher()
	{
	    return $this->belongsTo('User', 'teacher_id');
	}


}
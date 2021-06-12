<?php

class Emploi extends Eloquent {	
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'emploi_fste';


	public function Tclass()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}

	public function Tday()
	{
	    return $this->belongsTo('Days', 'the_day');
	}

	public function Tsubject()
	{
	    return $this->belongsTo('Subject', 'subject_id');
	}
	
	public function Thour()
	{
	    return $this->belongsTo('Hour', 'the_hour');
	}

	public function TEndhour()
	{
	    return $this->belongsTo('Hour', 'end_hour');
	}

	public function Teacher()
	{
	    return $this->belongsTo('User', 'teacher_id');
	}


	

}
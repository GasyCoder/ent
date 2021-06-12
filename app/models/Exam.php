<?php

class Exam extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'exams_fste';



	public function exClass()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}

	public function exSubject()
	{
	    return $this->belongsTo('Subject', 'subject_id');
	}

	public function exTeacher()
	{
	    return $this->belongsTo('User', 'teacher_id');
	}

	public function exStudents()
	{
		return $this->HasMany('User', 'class_id', 'class_id');
	}

}
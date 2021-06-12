<?php

class Marks extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'teachers_marks_fste';

	public function maClass()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}

	public function maSubject()
	{
	    return $this->belongsTo('Subject', 'subject_id');
	}

	public function maStudent()
	{
	    return $this->belongsTo('User', 'student_id');
	}

	public function maTeacher()
	{
	    return $this->belongsTo('User', 'teacher_id');
	}

	
}
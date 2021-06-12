<?php

class Lesson extends Eloquent {	
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'lessons_fste';

	public function lessTeacher()
	{
	    return $this->belongsTo('User', 'teacher_id');
	}

	public function maSubject()
	{
	    return $this->belongsTo('Subject', 'subject_id');
	}

	public function comments()
	{
		return $this->HasMany('LessonsComment');
	}

}
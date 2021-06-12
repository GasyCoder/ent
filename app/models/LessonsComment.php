<?php

class LessonsComment extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'lessons_comments_fste';

	public function lesson()
	{
		return $this->belongsTo('Lesson', 'lesson_id');
	}

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

}
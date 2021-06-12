<?php

class Comment extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'comments_fste';

	public function article()
	{
		return $this->belongsTo('Article', 'article_id');
	}

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

}
<?php

class Article extends Eloquent {
		
	protected $guarded = ['id', 'created_at'];

	protected $table = 'articles_fste';

	public function category()
	{
		return $this->belongsTo('Category', 'category_id');
	}
	
	public function comments()
	{
		return $this->HasMany('Comment');
	}

}
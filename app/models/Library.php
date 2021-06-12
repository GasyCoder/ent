<?php

class Library extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'library_fste';

	public function user()
	{
	    return $this->belongsTo('User', 'user_id');
	}

	public function category()
	{
	    return $this->belongsTo('TheCategoryLibrary', 'category_id');
	}

}
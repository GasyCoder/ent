<?php

class Category extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'categories_fste';

	public function articles()
	{
		return $this->hasMany('Article');
	}

}
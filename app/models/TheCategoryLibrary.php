<?php

class TheCategoryLibrary extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'library_categories_fste';

	public function files()
	{
		return $this->hasMany('Library');
	}

}
<?php

class Transport extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'transport_fste';

	public function Tclass()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}

	public function Tday()
	{
	    return $this->belongsTo('Days', 'day_id');
	}
	
}
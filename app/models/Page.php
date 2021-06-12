<?php

class Page extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'pages_fste';


}
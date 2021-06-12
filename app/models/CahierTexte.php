<?php

class CahierTexte extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'cahier_de_texte_fste';
	
	public function Tclass()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}

	public function TheTeacher()
	{
	    return $this->belongsTo('User', 'teacher_id');
	}

		public function Tsubject()
	{
	    return $this->belongsTo('Subject', 'subject_id');
	}
	
}
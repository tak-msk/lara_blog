<?php

class Category extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'category' => 'required'
	];

	// Don't forget to fill this array
	protected $guarded = ['id'];

	public function articles()
	{
		return $this->hasMany('Article');
	}
}

<?php

class Article extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'title' => 'required',
		'content' => 'required',
		'category_id' => 'exists:categories,id'
	];

	// Don't forget to fill this array
	protected $guarded = ['id'];

	public function category()
	{
		return $this->belongsTo('Category');
	}

}

<?php

class Article extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'title' => 'required',
		'content' => 'required',
		// 'category_id' => 'exists:categories,id'
	];

	// Don't forget to fill this array
	protected $fillable = ['id'];

}

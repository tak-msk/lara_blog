<?php

class Block extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'title' => 'required',
		'type' => 'required|in:0,1',
		'contents' => 'required'
	];

	// Don't forget to fill this array
	protected $guarded = array('id');

}

<?php

class AuthController extends \BaseController {

	/**
	 * Validation for login
	 *
	 * @return Redirect
	 */
	public function postLogin(){
		$inputs = Input::only(array('username','password'));
		$rules = array (
			'username' => array('required'),
			'password' => array('required'),
		);
		$val = Validator::make($inputs, $rules);
		if ($val->fails())
		{
			return Redirect::back()
			->withErrors($val)
			->withInput();
		}
		if(!Auth::attempt($inputs, (Input::get('remember','0') == '1')))
		{
			return Redirect::back()
			->withErrors(array('warning'=>'Login failed'))
			->withInput();
		}
		return Redirect::route('dashboard');
	}
	
	/**
	 * Logout
	 * @return Redirect
	 */
	public function getLogout(){
		Auth::logout();
		return Redirect::to('/');
	}
}

<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoriesController extends \BaseController {

	/**
	 * Display a listing of categories
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Category::all();

		return View::make('backend.categories.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new category
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('backend.categories.create');
	}

	/**
	 * Store a newly created category in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Category::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Category::create($data);

		Notification::success('Saved category');
		return Redirect::action('CategoriesController@index');
	}

	/**
	 * Display the specified category.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		/**
		 * $category = Category::findOrFail($id);
		 *
		 * return View::make('categories.show', compact('category'));
		 */ 	
		}

	/**
	 * Show the form for editing the specified category.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		try 
		{
			$category = Category::findOrFail($id);

			return View::make('backend.categories.edit', compact('category'));	
		}
		catch(ModelNotFoundException $e)
		{
			Notification::error('Category is not found');
			return Redirect::action('CategoriesController@index');
		}
	}

	/**
	 * Update the specified category in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try 
		{
			$category = Category::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			Notification::error('Category is not found');
			return Redirect::action('CategoriesController@index');
		}


		$validator = Validator::make($data = Input::all(), Category::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$category->update($data);

		Notification::success('Updated the category');
		return Redirect::action('CategoriesController@index');
	}

	/**
	 * Remove the specified category from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$article_count = Category::find($id)->articles->count();
		if($article_count > 0)
		{
			Notification::error('You can not delete this, because there are some articles related with this category.');
		}
		else
		{
			Category::destroy($id);

			Notification::success('Deleted the category');
		}
		return Redirect::action('backend.categories.index');
	}

}

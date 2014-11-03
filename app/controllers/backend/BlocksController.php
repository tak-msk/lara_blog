<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlocksController extends \BaseController {

	/**
	 * Display a listing of blocks
	 *
	 * @return Response
	 */
	public function index()
	{
		$blocks = Block::orderBy('order', 'ASC')->get();

		return View::make('backend.blocks.index', compact('blocks'));
	}

	/**
	 * Show the form for creating a new block
	 *
	 * @return Response
	 */
	public function create()
	{
		$modules = Helpers::getModuleNames();
		return View::make('backend.blocks.create', compact('modules'));
	}

	/**
	 * Store a newly created block in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::except('module'), Block::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$data['is_published'] = isset($data['is_published']) ? true : false;

		Block::create($data);

		Notification::success('Saved a block');
		return Redirect::action('BlocksController@index');
	}

	/**
	 * Display the specified block.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	//	$block = Block::findOrFail($id);
	//
	//	return View::make('blocks.show', compact('block'));
	}

	/**
	 * Show the form for editing the specified block.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		try
		{
			$block = Block::find($id);

			$modules = Helpers::getModuleNames();
			return View::make('backend.blocks.edit', compact('block','modules'));
		}
		catch(ModelNotFoundException $e)
		{
			Notification::error('A block is not found');
			return Redirect::action('BlocksController@index');
		}	
	}

	/**
	 * Update the specified block in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try
		{
			$block = Block::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			Notification::error('A block is not found');
			return Redirect::action('BlocksController@index');
		}
		
		$validator = Validator::make($data = Input::except('module'), Block::$rules);
		
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$data['is_published'] = isset($data['is_published']) ? true : false;

		$block->update($data);

		Notification::success('A block was updated');
		return Redirect::action('BlocksController@index');
	}

	/**
	 * Remove the specified block from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Block::destroy($id);
	
		Notification::success('A block was deleted');
		return Redirect::action('BlocksController@index');
	}
	
	/**
	 * Sort a listing of blocks
	 *
	 * @return Response
	 */
	public function sort()
	{
		$result = Input::get('result');
		$arr = explode(',', $result);
		$i = 1;

		foreach($arr as $id)
		{
			$block = Block::find($id);

			$block->order = $i;
			$block->save();

			$i++;
		}
		
		Notification::success('Ordering updated');
		return Redirect::action('BlocksController@index');
	}
}

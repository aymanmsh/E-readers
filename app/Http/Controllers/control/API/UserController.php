<?php

namespace App\Http\Controllers\control\API;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{


    public function index() {
    	$users = User::all();
    	return parent::success($users);
    }



	public function show($id) {
    	try{
    		$user = User::findOrFail($id);
    		return parent::success($user);
    	} catch (ModelNotFoundException $ModelNotFoundException) {
    		return parent::error('User Not Found!!', 404);
    	}
    }



    public function store(Request $request) {
    	$validation = \Validator::make($request->all(), $this->rules());
    	if($validation->fails()) {
            return parent::error($validation->errors(), 400);
        }
    	$request['password'] = \Hash::make($request->input['password']);
    	$user = new User();
    	$user->fill($request->all());
    	$user->save();
    	return parent::success($user, 200);
    }



    public function update(Request $request, $id) {
    	$validation = \Validator::make($request->all(), $this->rules($id));
    	if($validation->fails())
    		return parent::error($validation->errors());
    	try {
    		$user = User::findOrFail($id);
    		$user->fill($request->all());
    		$user->update();
    		return parent::success($user);
    	} catch(ModelNotFoundException $ModelNotFoundException) {
    		return parent::error('User Not Found!!', 404);
    	}
    }

    public function destroy($id) {
    	try {
    		$user = User::findOrFail($id);
    		$result = $user->delete();
    		if( $result === TRUE )
    			return parent::success($user, 200);
    		return parent::error('Some Thing Went Wrong!!');
    	} catch (ModelNotFoundException $ModelNotFoundException) {
    		return parent::error('User Not Found!!', 404);
    	}
    }

    private function rules($id = null) {
    	$rules =  [
    		'name' => 'required|min:3',
    		'email' => 'required|email|unique:users,email' . ($id != null ? ',' . $id : ''),
    		'password' => 'required|min:6|max:32',
    	];
    	if($id) {
    		unset($rules['password']);
    	}
    	return $rules;
    }
}

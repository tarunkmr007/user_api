<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class UserController extends Controller
{
    public function register(Request $request){

    	$validator = Validator::make($request->all(),[
    		'name' => 'required',
    		'email' => 'required',
    		'password' => 'required',
    		'c_password' => 'required| same:password'
    	]);

    	if($validator->fails()){
    		return response()->json(['error' => $validator->errors()],401);
    	}

    	$user = User::create([
		    		'name' => $request->name,
		    		'email' => $request->email,
		    		'password' => bcrypt($request->password)
    	]);
    	

    	$success['token'] =  $user->createToken('MyApp')-> accessToken;

    	$success['name'] = $user->name;
    	$success['msg'] = 'Registered Successfully';

    	return response()->json(['success' => $success],200);
    }

    public function login(Request $request){
    	if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
    		$user = Auth::user();

    		$success['token'] =  $user->createToken('MyApp')-> accessToken;
    		$success['msg'] = 'You are logged in!';

    		return response()->json(['success' => $success],200);
    	}
    	else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

	public function logout(Request $request){
		if (Auth::check()) {
			$request->user()->token()->revoke();
		}
		return response()->json(['message' => 'User logged out'], 200);
	}

	public function update(Request $request){
		if (Auth::check()) {
			$user = Auth::user();

			$user->update($request->all());
			$user->update(['update' => bcrypt($request->password)]);

			$user->user_detail()->create([
    			'mother' => $request->mother,
    			'father' => $request->father
    		]);
		}

		return response()->json(['success' => 'Profile Updated'],200);
	}
}

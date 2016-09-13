<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;

class MyAccountController extends Controller
{
    public function edit()
    { 
    	$user = Auth::user();

    	return view('myaccount.edit', compact('user'));
    }

    public function editSave(Request $request)
    {
    	$user = Auth::user();

    	$this->validate($request, [
    		'email' => 'email|required_without:username',
    		'username' => 'required_without:email',
    		'plz' => 'digits:4'
    	]);

    	$user->name = $request['name'];
    	$user->username = $request['username'];
    	$user->email = $request['email'];
    	$user->street = $request['street'];
    	if($request['plz']) $user->plz = $request['plz'];
    	$user->city = $request['city'];
        $user->birthdate = date("Y-m-d", strtotime($request['birthdate']));
    	$user->phone = $request['phone'];
    	$user->save();

    	return redirect('/benutzerkonto/adresse')->with('status', 'Die Angaben wurden erfolgreich geändert');
    }

    public function changepw()
    {
    	return view('myaccount.changepw');
    }

    public function changepwSave(Request $request)
    {
    	$user = Auth::user();

    	$this->validate($request, [
	        'password' => 'required|min:6|confirmed',
	        'password_confirmation' => 'required|min:6',
	    ]);

    	$user->password = Hash::make($request->password);
    	$user->save();

    	return redirect('/benutzerkonto/passwort')->with('status', 'Das Passwort wurde erfolgreich geändert');
    }

}

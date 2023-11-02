<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userList(){
        $users = User::get(['id','name','email']);
        return view('users-list.index',compact('users'));
    }
    public function status($id)
    {
        try {
            $user = User::find($id);
            $user->role = $user->role == '1' ? '0' : '1';
            $user->save();
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->with('msg', 'try After sometimes');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('cors');
        $this->middleware('auth');
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function allUsers()
    {
         return response()->json(['users' =>  User::all()], 200);
    }

    /**
     * Get one user.
     *
     * @return Response
     */
    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json(['user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'user not found!'], 404);
        }
    }

    /**
     * Set user active or inactive
     * 
     * @return Response
     */
    public function updateUser($id, Request $request)
    {
        try {
            $user = User::findOrFail($id);
            if($request->input('name')) {
                $user->name = $request->input('name');
            }
            if($request->input('isactive')) {
                $user->isactive = $request->input('isactive');
            }
            if($request->input('password')) {
                $plainPassword = $request->input('password');
                $user->password = app('hash')->make($plainPassword);
            }
            $user->save();
            return response()->json(['user' => $user]);
        } catch(\Exception $e) {
            return response()->json(['message' => 'user not found'], 404);
        }
    }
}

?>
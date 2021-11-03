<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Get the validation of token.
     *
     * @return Response
     */
    public function token()
    {
        return response()->json(['isauthorized' => true], 200);
    }
}
?>
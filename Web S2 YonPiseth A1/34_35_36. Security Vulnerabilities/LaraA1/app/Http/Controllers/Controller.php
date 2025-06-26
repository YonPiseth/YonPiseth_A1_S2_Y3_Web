<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    public function submitData(Request $request)
    {
        $input = $request->input('user_input');
        return view('welcome', ['input' => $input]);
    }
}

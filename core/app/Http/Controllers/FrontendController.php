<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        $data = [

        ];

        return view('pages.index', $data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        return view('pages.index');
    }

    public function dashboard() {
        $projects = '';
        $tasks = '';

        $data = [
            'projects' => $projects,
            'tasks' => $tasks,
        ];

        return view('pages.dashboard', $data);
    }

    public function project() {
        $data = [

        ];

        return view('pages.project', $data);
    }

    public function login() {
        return view('pages.login');
    }

    public function signup() {
        return view('pages.signup');
    }

    public function swagger() {
        return view('pages.swagger');
    }
}

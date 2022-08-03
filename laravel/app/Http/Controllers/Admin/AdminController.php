<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.home');
    }

    public function getUsers()
    {
        $users = User::paginate(50);

        return view('admin.users.index', [
            'status' => '',
            'users' => $users
        ]);
    }

}

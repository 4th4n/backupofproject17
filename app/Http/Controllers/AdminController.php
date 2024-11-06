<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class AdminController extends Controller
// {
//     // Display the admin dashboard
//     public function index()
//     {
//         // Pass data to the view, for example, admin users
//         $adminUsers = User::where('is_admin', true)->get();
//         return view('admin.index', compact('adminUsers'));
//     }

//     // Display a form to add a new admin user
//     public function create()
//     {
//         return view('admin.create');
//     }

//     // Handle form submission for creating an admin user
//     public function store(Request $request)
//     {
//         // Validation and creation logic here
//     }
// }
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showDashboard()
    {
        return view('admin.dashboard'); // Loads resources/views/admin/dashboard.blade.php
    }
}

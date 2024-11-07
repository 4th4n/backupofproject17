<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class AuthController extends Controller
// {
//     // Method para sa pag-display ng login page
//     public function showLoginForm()
//     {
//         return view('login'); // Load ang login.blade.php
//     }

//     // Method para sa pag-handle ng login logic
//     public function login(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',
//         ]);
    
//         // Check if the user exists
//         $user = \App\Models\User::where('email', $request->email)->first();
    
//         if ($user) {
//             // Check if the password matches
//             if (Hash::check($request->password, $user->password)) {
//                 Auth::login($user);
//                 return redirect()->intended('dashboard');
//             } else {
//                 return back()->withErrors(['password' => 'Invalid password.']);
//             }
//         } else {
//             return back()->withErrors(['email' => 'No user found with that email.']);
//         }
//     }
// }
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(); // Generates all authentication routes

// Protected Admin Routes
Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::get('/orders/view', [OrderController::class, 'view'])->name('orders.view');
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
});

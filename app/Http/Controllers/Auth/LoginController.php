<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Fungsi untuk menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Fungsi untuk melakukan proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'gudang') {
                return redirect()->route('gudang.dashboard');
            }
        }

        return redirect()->route('login')->with('error', 'Login details are not valid');
    }

    // Fungsi untuk melakukan proses logout
    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
        return redirect()->route('login'); // Redirect ke halaman login
    }
}

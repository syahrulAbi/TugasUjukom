<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use App\Models\pengguna;

class userController extends Controller
{
    public function index()
    {
        $pengguna = pengguna::all();
        return view('data_user', compact('pengguna'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:penggunas',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        pengguna::create([
            'user' => $request->user,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'role' => $request->role,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'berhasil.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:penggunas',
            'password' => 'nullable|string|min:8', // Make password nullable to allow updating other fields without changing the password
            'role' => 'required|string',
        ]);

        $pengguna = pengguna::find($id);
        $pengguna->user = $request->user;
        $pengguna->email = $request->email;

        if ($request->filled('password')) {
            $pengguna->password = Hash::make($request->password); // Hash the password if it is provided
        }

        $pengguna->role = $request->role;
        $pengguna->save();

        return redirect()->route('pengguna.index')->with('success', 'berhasil.');
    }

    public function destroy($id)
    {
        $pengguna = pengguna::find($id);
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'berhasil.');
    }
}

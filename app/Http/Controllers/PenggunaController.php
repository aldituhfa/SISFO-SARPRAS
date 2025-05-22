<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $penggunas = Pengguna::all();
        return view('penggunas.index', compact('penggunas'));
    }

    public function create()
    {
        return view('penggunas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no' => 'required|unique:penggunas,no',
            'name' => 'required',
            'email' => 'required|email|unique:penggunas,email',
            'password' => 'required|min:6',
        ]);

        Pengguna::create([
            'no' => $request->no,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('penggunas.index')->with('success', 'Akun pengguna berhasil ditambahkan.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $pengguna = Pengguna::where('email', $request->email)->first();

        if (!$pengguna || !Hash::check($request->password, $pengguna->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        $token = $pengguna->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'user' => $pengguna,
                'token' => $token
            ]
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required | regex:/[A-Z]/',
            'nisn' => 'required | min:10 | numeric',
            'nis' => 'required | min:5 | numeric',
            'kelas' => 'required | numeric',
            'jurusan' => 'required | numeric'
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan
        ]);

        $token = $user->createToken('auth-sanctum')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required | regex:/[A-Z]/',
            'nisn' => 'required | min:10 | numeric',
        ]);

        // if (!Auth::attempt(
        //     $request->only('nama','nisn')
        // )) {
        //     return response()
        //     ->json(['pesan' => 'Berhasil Login!'], 401);
        // }

        $user = User::where('nisn', $request->nisn)->firstOrFail();

        $token = $user->createToken('auth-sanctum')->plainTextToken;

        if ($user){
            return response()
            ->json(['pesan' => 'Berhasil Login!',
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'], 401);

        } else {
            return response()
            ->json(['pesan' => 'Gagal Login!',
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'], 404);
        }

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'msg' => 'Berhasil Logout'
        ]);
    }
}

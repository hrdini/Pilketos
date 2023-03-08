<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required | regex:/[A-Z]/',
            'nip' => 'required | min:18 | numeric',
        ]);

        $user = Guru::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
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
            'nip' => 'required | min:18 | numeric',
        ]);

        // if (!Auth::attempt(
        //     $request->only('nama','nip')
        // )) {
        //     return response()
        //     ->json(['pesan' => 'Berhasil Login!'], 401);
        // }

        $user = Guru::where('nip', $request->nip)->where('nama', $request->nama)->firstOrFail();
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

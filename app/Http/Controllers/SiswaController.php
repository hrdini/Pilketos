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

        return response()->json([
            'pesan'=>'Data Berhasil Disimpan',
            'data' => $user,
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

        $user = User::where('nama', $request->nama)->where('nisn', $request->nisn)->firstOrFail();

        if ($user){
            return response()
            ->json(['pesan' => 'Berhasil Login!',
            'data' => $user], 401);

        } else {
            return response()
            ->json(['pesan' => 'Gagal Login!',
            'data' => $user], 404);
        }

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'msg' => 'Berhasil Logout'
        ]);
    }

    public function index()
    {
        $data = User::all();

        return response()->json($data);
    }
    
    public function show($id)
    {
        $data = User::where('id',$id)->get();

        return response()->json($data);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'nama' => 'required | regex:/[A-Z]/',
            'nisn' => 'required | min:10 | numeric',
            'nis' => 'required | min:5 | numeric',
            'kelas' => 'required | numeric',
            'jurusan' => 'required | numeric'
        ]);

        $data = [
            'nama'=>$request->input('nama'),
            'nisn'=>$request->input('nisn'),
            'nis'=>$request->input('nis'),
            'kelas'=>$request->input('kelas'),
            'jurusan'=>$request->input('jurusan'),
        ];

        $user = User::where('id',$id)->update($data);

        if($user){
            return response()->json([
                'pesan'=>'Data berhasil disimpan',
                'status'=>200,
                'data'=>$data
            ]);
        }
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();

        if($user){
            return response()->json([
                'pesan'=>'Data berhasil dihapus',
                'status'=>200
            ]);
        }
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required | regex:/[A-Z]/',
            'nisn' => 'required | min:10 | numeric',
            'nis' => 'required | min:5 | numeric',
            'kelas' => 'required | numeric',
            'jurusan' => 'required | numeric'
        ]);

        $data = [
            'nama'=>$request->input('nama'),
            'nisn'=>$request->input('nisn'),
            'nis'=>$request->input('nis'),
            'kelas'=>$request->input('kelas'),
            'jurusan'=>$request->input('jurusan')
        ];

        $user = User::create($data);

        if($user){
            return response()->json([
                'pesan'=>'Data berhasil disimpan',
                'status'=>200,
                'data'=>$data
            ]);
        }
    }
}

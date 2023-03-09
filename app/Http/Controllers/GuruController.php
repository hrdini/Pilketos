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

        return response()->json([
            'pesan' => 'Data sudah ditambahkan',
            'data' => $user,
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
        $data = Guru::all();

        return response()->json($data);
    }
    
    public function show($id)
    {
        $data = Guru::where('id',$id)->get();

        return response()->json($data);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'nama' => 'required | regex:/[A-Z]/',
            'nip' => 'required | min:18 | numeric',
        ]);

        $data = [
            'nama'=>$request->input('nama'),
            'nip'=>$request->input('nip'),
        ];

        $guru = Guru::where('id',$id)->update($data);

        if($guru){
            return response()->json([
                'pesan'=>'Data berhasil disimpan',
                'status'=>200,
                'data'=>$data
            ]);
        }
    }

    public function destroy($id)
    {
        $guru = Guru::where('id', $id)->delete();

        if($guru){
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
            'nip' => 'required | min:18 | numeric',
        ]);

        $data = [
            'nama'=>$request->input('nama'),
            'nip'=>$request->input('nip'),
        ];

        $guru = Guru::create($data);

        if($guru){
            return response()->json([
                'pesan'=>'Data berhasil disimpan',
                'status'=>200,
                'data'=>$data
            ]);
        }
    }
}

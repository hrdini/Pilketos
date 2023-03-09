<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Admin::all();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'username'=>'required | alpha_dash | max:255',
            'code'=>'required | numeric'
        ]);

        $data = [
            'username'=>$request->input('username'),
            'code'=>$request->input('code'),
        ];

        $admin = Admin::create($data);

        if($admin){
            return response()->json([
                'pesan'=>'Data berhasil disimpan',
                'status'=>200,
                'data'=>$data
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Admin::where('id',$id)->get();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'username'=>'required | alpha_dash | max:255',
            'code'=>'required | numeric'
        ]);

        $data = [
            'username'=>$request->input('username'),
            'code'=>$request->input('code'),
        ];

        $admin = Admin::where('id',$id)->update($data);

        if($admin){
            return response()->json([
                'pesan'=>'Data berhasil disimpan',
                'status'=>200,
                'data'=>$data
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::where('id', $id)->delete();

        if($admin){
            return response()->json([
                'pesan'=>'Data berhasil dihapus',
                'status'=>200
            ]);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'=>'required | alpha_dash | max:255',
            'code'=>'required | numeric'
        ]);

        // if (!Auth::attempt(
        //     $request->only('nama','nip')
        // )) {
        //     return response()
        //     ->json(['pesan' => 'Berhasil Login!'], 401);
        // }

        $user = Admin::where('nama', $request->nama)->where('code', $request->code)->firstOrFail();
        
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
}

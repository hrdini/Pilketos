<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Http\Requests\StoreKandidatRequest;
use App\Http\Requests\UpdateKandidatRequest;
use Illuminate\Http\Request;

class KandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kandidat::all();
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
            'gambar' => 'required ',
            'nama_ketua' => 'required | string',
            'ketua_id' => 'required | numeric',
            'nama_wakil' => 'required | string',
            'wakil_id' => 'required | numeric',
            'visi' => 'required | string',
            'misi' => 'required | string',
            'periode' => 'required | numeric',
            'terpilih' => 'required | boolean',
        ]);

        $gambar = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->move('upload', $gambar);

        $data = [
            'gambar' => url('upload/'.$gambar),
            'nama_ketua' => $request->input('nama_ketua'),
            'ketua_id' => $request->input('ketua_id'),
            'nama_wakil' => $request->input('nama_wakil'),
            'wakil_id' => $request->input('wakil_id'),
            'visi' => $request->input('visi'),
            'misi' => $request->input('misi'),
            'periode' => $request->input('periode'),
            'terpilih' => $request->input('terpilih'),
        ];

        $kandidat = Kandidat::create($data);

        if ($kandidat) {
            $result = [
                //'status' => 200,
                'pesan' => 'Data sudah ditambahkan',
                'data' => $data
            ];
        } else {
            $result = [
                //'status' => 400,
                'pesan' => 'Data Gagal Ditambahkan',
                'data' => ''
            ];
        }
        
        return response()->json($result,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKandidatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKandidatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kandidat::where('id',$id)->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    public function edit(Kandidat $kandidat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKandidatRequest  $request
     * @param  \App\Models\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Kandidat::where('id', $id)->update($request->all());

        return response()->json("data sudah diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $run = Kandidat::where('id', $id)->delete();

        if($run){
            return response()->json([
                'pesan'=>'Data berhasil dihapus',
                'status'=>200
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;


use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Reservasi;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservasis = DB::table('reservasi')
            ->join('kamar', 'reservasi.kd_kamarr', '=', 'kamar.kd_kamar')
            ->get();
        return view('reservasi.index', compact('reservasis'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kamars = Kamar::all();
        return view('reservasi.create', compact('kamars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_reservasi' => 'required',
            'nm_costumer' => 'required',
            'kd_kamarr' => 'required',
            'jumlah' => 'required',
        ]);

        Reservasi::create($request->all());
        return redirect()->route('reservasi.index')
            ->with('success', 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservasi $reservasi)
    {
        return view('reservasi.edit', compact('reservasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Reservasi $reservasi)
    {
        $request->validate([
            'tgl_reservasi' => 'required',
            'nm_costumer' => 'required',
            'kd_kamarr' => 'required',
            'jumlah' => 'required',
        ]);

        $reservasi->update($request->all());
        return redirect()->route('reservasi.index')->with('success', 'Data berhasil dirubah');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Reservasi::where('id', $id)->first();
        File::delete(public_path('fotokamar' . '/' . $data->foto));

        Reservasi::where('id', $id)->delete();
        return redirect('/reservasi')->with('success', 'Berhasil hapus data');
    }
}

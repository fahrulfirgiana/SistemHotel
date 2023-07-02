<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kamar::orderBy('id_kamar', 'asc')->paginate(3);
        return view('kamar/index')->with('data', $data)->with('i', (request()->input('page', 1) - 1) * 3);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kamar/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('kd_kamar', $request->kd_kamar);
        Session::flash('no_kamar', $request->no_kamar);
        Session::flash('jenis', $request->jenis);
        Session::flash('fasilitas', $request->fasilitas);
        Session::flash('harga', $request->harga);
        Session::flash('stok', $request->stok);

        $request->validate([
            'kd_kamar' => 'required|numeric',
            'no_kamar' => 'required|numeric',
            'jenis' => 'required',
            'fasilitas' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'foto' => 'required|mimes:jpeg,jpg,png,gif',
            // |mimes:jpeg,jpg,png,gif adalah untuk membatasi hanya untuk ekstensi tertentu sesuai kebutuhan
        ], [
            'kd_kamar.required' => 'Kode kamar wajib diisi',
            'kd_kamar.numeric' => 'Kode kamar wajib diisi dalam angka',
            'no_kamar.required' => 'Nomor kamar wajib diisi',
            'no_kamar.numeric' => 'Nomor kamar wajib diisi dalam angka',
            'jenis.required' => 'Jenis wajib diisi',
            'fasilitas.required' => 'Fasilitas wajib diisi',
            'harga.required' => 'Harga wajib diisi',
            'harga.numeric' => 'Harga wajib diisi dalam angka',
            'stok.required' => 'Stok wajib diisi',
            'stok.numeric' => 'Stok wajib diisi dalam angka',
            'foto.required' => 'Foto wajib diisi',
            'foto.mimes' => 'Foto hanya diperbolehkan berekstensi JPEG, JPG, PNG, dan GIF',
        ]);
        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
        $foto_file->move(public_path('fotokamar'), $foto_nama);

        $data = [
            'kd_kamar' => $request->input('kd_kamar'),
            'no_kamar' => $request->input('no_kamar'),
            'jenis' => $request->input('jenis'),
            'fasilitas' => $request->input('fasilitas'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'foto' => $foto_nama
        ];
        Kamar::create($data);
        return redirect('/kamar')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kamar::where('id_kamar', $id)->first();
        return view('kamar/detail')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Kamar::where('id_kamar', $id)->first();
        return view('kamar/edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([ // ini untuk proseses validate 
            'kd_kamar' => 'required|numeric',
            'no_kamar' => 'required|numeric',
            'jenis' => 'required',
            'fasilitas' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ], [
            'kd_kamar.required' => 'Kode kamar wajib diisi',
            'kd_kamar.numeric' => 'Kode kamar wajib diisi dalam angka',
            'no_kamar.required' => 'Nomor kamar wajib diisi',
            'no_kamar.numeric' => 'Nomor kamar wajib diisi dalam angka',
            'jenis.required' => 'Jenis wajib diisi',
            'fasilitas.required' => 'Fasilitas wajib diisi',
            'harga.required' => 'Harga wajib diisi',
            'harga.numeric' => 'Harga wajib diisi dalam angka',
            'stok.required' => 'Stok wajib diisi',
            'stok.numeric' => 'Stok wajib diisi dalam angka',
        ]);
        $data = [ // ini adalah data apa saja yang akan disimpan
            'kd_kamar' => $request->input('kd_kamar'),
            'no_kamar' => $request->input('no_kamar'),
            'jenis' => $request->input('jenis'),
            'fasilitas' => $request->input('fasilitas'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
        ];
        // ini untuk proses membuang foto lama dan diganti dengan yg baru
        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'mimes:jpeg,jpg,png,gif'
            ], [
                'foto.mimes' => 'foto hanya diperbolehkan berekstensi JPEG, JPG, PNG, dan GIF'
            ]);
            // untuk proses menyimpan foto baru
            $foto_file = $request->file('foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('fotokamar'), $foto_nama); //sudah terupload ke direktori

            $data_foto = Kamar::where('id_kamar', $id)->first(); //ini untuk mencari nama foto yang akan dihapus berdasarkan id
            File::delete(public_path('fotokamar' . '/' . $data_foto->foto));

            // $data = [
            //     'foto' => $foto_nama
            // ];
            $data['foto'] = $foto_nama;
        }
        kamar::where('id_kamar', $id)->update($data);
        return redirect('/kamar')->with('success', 'Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = kamar::where('id_kamar', $id)->first();
        File::delete(public_path('fotokamar' . '/' . $data->foto));

        kamar::where('id_kamar', $id)->delete();
        return redirect('/kamar')->with('success', 'Berhasil hapus data');
    }
}

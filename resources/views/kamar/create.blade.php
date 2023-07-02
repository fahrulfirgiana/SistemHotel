@extends('layout')
@section('content')
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $item)
            <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-edit mr-1"></i>Data Kamar</div>
        <div class="card-body">
<form method="post" action="/kamar" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label for="nm_produk" class="form-label">Kode Kamar</label>
    <input type="text" class="form-control" name="kd_kamar" id="nm_produk" value="{{ Session::get('kd_kamar')}}">
  </div>
  <div class="mb-3">
    <label for="harga" class="form-label">No Kamar</label>
    <input type="text" class="form-control" name="no_kamar" id="harga" value="{{ Session::get('no_kamar')}}">
  </div>
  <div class="mb-3">
    <label for="stok" class="form-label">Jenis</label>
    <input type="text" class="form-control" name="jenis" id="stok" value="{{ Session::get('jenis')}}">
  </div>
  <div class="mb-3">
    <label for="stok" class="form-label">Fasilitas</label>
    <input type="text" class="form-control" name="fasilitas" id="stok" value="{{ Session::get('fasilitas')}}">
  </div>
  <div class="mb-3">
    <label for="stok" class="form-label">Harga</label>
    <input type="text" class="form-control" name="harga" id="stok" value="{{ Session::get('harga')}}">
  </div>
  <div class="mb-3">
    <label for="stok" class="form-label">Stok</label>
    <input type="text" class="form-control" name="stok" id="stok" value="{{ Session::get('stok')}}">
  </div>
  <div class="mb-3">
    <label for="gambar" class="form-label">Foto</label>
    <input type="file" class="form-control" name="foto" id="gambar">
  </div>
  <div class="mb-3">
    <button type="submit" class="btn btn-primary btn-icon-text"><i class="ti-file btn-icon-prepend"> </i>Submit</button>
    <a class="btn btn-primary" href="/kamar"> Back</a>
</div>
  </div>
</form>
@endsection
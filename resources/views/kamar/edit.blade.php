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
        <div class="card-header"><i class="fas fa-edit mr-1"></i>Data Barang/Produk</div>
        <div class="card-body">
<form method="post" action="{{ '/kamar/'.$data->id_kamar }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label for="nm_produk" class="form-label">Kode Kamar</label>
    <input type="text" class="form-control" name="kd_kamar" id="nama" value="{{$data->kd_kamar}}">
  </div>
  <div class="mb-3">
    <label for="harga" class="form-label">No Kamar</label>
    <input type="text" class="form-control" name="no_kamar" id="nama" value="{{$data->no_kamar}}">
  </div>
  <div class="mb-3">
    <label for="stok" class="form-label">Jenis</label>
    <input type="text" class="form-control" name="jenis" id="nama" value="{{$data->jenis}}">
  </div>
  <div class="mb-3">
    <label for="stok" class="form-label">Fasilitas</label>
    <input type="text" class="form-control" name="fasilitas" id="nama" value="{{$data->fasilitas}}">
  </div>
  <div class="mb-3">
    <label for="stok" class="form-label">Harga</label>
    <input type="text" class="form-control" name="harga" id="nama" value="{{$data->harga}}">
  </div>
  <div class="mb-3">
    <label for="stok" class="form-label">Stok</label>
    <input type="text" class="form-control" name="stok" id="nama" value="{{$data->stok}}">
  </div>
  @if ($data->foto)
      <div class="mb-3">
        <img style="width: 1000px; height:1000px" src="{{ url('fotokamar'.'/'.$data->foto) }}" alt="">
      </div>
  @endif
  <div class="mb-3">
    <label for="gambar" class="form-label">Foto</label>
    <input type="file" class="form-control" name="gambar" id="foto">
  </div>
  <div class="mb-3">
    <button type="submit" class="btn btn-success">Submit</button>
    <a class="btn btn-primary" href="/produk"> Back</a>
</div>
  </div>
</form>
@endsection
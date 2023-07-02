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
        <div class="card-header"><i class="fas fa-edit mr-1"></i>Data Reservasi</div>
        <div class="card-body">
          <form action="{{ route('reservasi.update',$reservasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
  <div class="mb-3">
    <label for="nm_produk" class="form-label">Tanggal Reservasi</label>
    <input type="date" class="form-control" name="tgl_reservasi" id="nm_produk" value="{{ $reservasi->tgl_reservasi }}">
  </div>
  <div class="mb-3">
    <label for="harga" class="form-label">Nama Costumer</label>
    <input type="text" class="form-control" name="nm_costumer" id="harga" value="{{ $reservasi->nm_costumer }}">
  </div>
  <div class="mb-3">
    <div class="form-group">
        <label for="stok" class="form-label">Pilih Kamar</label>
        <select name="kd_kamarr" class="form-control">
        <option value="">~Pilih Jenis Kamar~</option>
        <option value="1">VIP</option>
        <option value="2">Biasa</option>
        </select>
    </div>
  <div class="mb-3">
    <label for="stok" class="form-label">Jumlah</label>
    <input type="text" class="form-control" name="jumlah" id="stok" value="{{ $reservasi->jumlah }}">
  </div>
  <div class="mb-3">
    <button type="submit" class="btn btn-primary btn-icon-text"><i class="ti-file btn-icon-prepend"> </i> Submit</button>
    <a class="btn btn-primary" href="/reservasi"> Back</a>
</div>
  </div>
</form>
@endsection
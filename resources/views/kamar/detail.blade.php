@extends('layout')

@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">DataTable Kamar</h6>
	</div>
  <div class="content table-responsive table-full-width">
    <table class="table table-hover table-striped">
      <tbody><tr>
          <td width="40%">Kode Kamar</td><td>:</td>
          <td>{{ $data->kd_kamar }}</td>
      </tr>
      <tr>
          <td>No Kamar</td><td>:</td>
          <td>{{ $data->no_kamar }}</td>
      </tr>
      <tr>
          <td>Jenis</td><td>:</td>
          <td>{{ $data->jenis }}</td>
      </tr>
      <tr>
          <td>Fasilitas</td><td>:</td>
          <td>{{ $data->fasilitas }}</td>
      </tr>
      <tr>
          <td>Harga</td><td>:</td>
          <td>{{ $data->harga }}</td>
      </tr>
      <tr>
          <td>Stok</td><td>:</td>
          <td>{{ $data->stok }}</td>
      </tr>
      <tr>
          <td>Foto</td><td>:</td>
          <td>@if ($data->foto)
                <img style="max-width: 100px; max-height:40px" src="{{ url('fotokamar').'/'.$data->foto }}">
              @endif
          </td>
      </tr>
      <tr><td>
        <a href='/kamar' class="btn btn-secondary btn-sm">Kembali</a></td></tr>
  </tbody></table>
  </div>
  </div>
  </div>
  </div>
@endsection
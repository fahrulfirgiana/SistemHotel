@extends('layout')

@section('content')
  
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">DataTable Reservasi</h6>
	</div>
    <div class="card-body">
        <div class="table-responsive">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="container">
                <a class="btn btn-primary btn-sm" href="{{ "/reservasi/create" }}"><i class="fa-solid fa-plus"></i> Tambah Data</a>
                <p></p>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="table-responsive">
                          <table id="example" class="display expandable-table" style="width:100%">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Tanggal Reservasi</th>
                                <th>Nama Costumer</th>
                                <th>Kode Kamar</th>
                                <th>Jenis Kamar</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($reservasis as $reservasi)
                              <tr>
                                  <td>{{++$i}}</td>
                                  <td>
                                    @if ($reservasi->foto)
                                          <img style="max-width: 50px; max-height:50px" src="{{ url('fotokamar').'/'.$reservasi->foto }}">
                                      @endif
                                  </td>
                                  <td>{{ $reservasi->tgl_reservasi }}</td>
                                  <td>{{ $reservasi->nm_costumer }}</td>
                                  <td>{{ $reservasi->kd_kamar }}</td>
                                  <td>{{ $reservasi->jenis }}</td>
                                  <td>{{ $reservasi->jumlah }}</td>
                                  <td>
                                    <a class="btn btn-warning btn-sm" href="{{ route('reservasi.edit',$reservasi->id) }}"> Ubah</a>
                                    <form class="d-inline" action="{{route('reservasi.destroy',$reservasi->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="javascript: return confirm('Apakah anda yakin ingin menghapus data ini?')"> Hapus</button>
                                    </form>
                                </td>
                              </tr>
                          @endforeach
                          </tbody>
                        </table>
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="container container-fluid">
                    </div>
                  </div>
                </div>
              </div>
          </div>
@endsection
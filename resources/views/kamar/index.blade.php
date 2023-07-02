@extends('layout')

@section('content')
  
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">DataTable Kamar</h6>
	</div>
    <div class="card-body">
        <div class="table-responsive">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="container">
                <a class="btn btn-primary btn-sm" href="{{ "/kamar/create" }}"><i class="fa-solid fa-plus"></i> Tambah Data</a>
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
                                <th>Kode Kamar</th>
                                <th>No Kamar</th>
                                <th>Jenis</th>
                                <th>Fasilitas</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($data as $item)
                              <tr>
                                  <td>{{++$i}}</td>
                                  <td>
                                      @if ($item->foto)
                                          <img style="max-width: 50px; max-height:50px" src="{{ url('fotokamar').'/'.$item->foto }}">
                                      @endif
                                  </td>
                                  <td>{{ $item->kd_kamar }}</td>
                                  <td>{{ $item->no_kamar }}</td>
                                  <td>{{ $item->jenis }}</td>
                                  <td>{{ $item->fasilitas }}</td>
                                  <td>{{ $item->harga }}</td>
                                  <td>{{ $item->stok }}</td>
                                  <td>
                                      <a class="btn btn-secondary btn-sm" href='{{ url('/kamar/'.$item->id_kamar) }}'>Detail</a>
                                      <a class="btn btn-warning btn-sm" href='{{ url('/kamar/'.$item->id_kamar.'/edit') }}'>Edit</a>
                                      <form class="d-inline" action="{{ '/kamar/'.$item->id_kamar }}" method="POST">
                                          {{-- $nomor_induk adalah id-nya --}}
                                      @csrf
                                      @method('DELETE')
                                      <button class= "btn btn-danger btn-sm" type="submit" onclick="javascript: return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
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
                      {{ $data->links() }}
                    </div>
                  </div>
                </div>
              </div>
          </div>
@endsection
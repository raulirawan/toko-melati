@extends('layouts.dashboard-admin')

@section('title','Halaman Ukuran')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ukuran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ukuran</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
        <div class="row">
          <div class="col-12">
              @if(session()->has('sukses'))
              <div class="alert alert-success">
                  {{ session()->get('sukses') }}
              </div>
              @endif
              @if(session()->has('error'))
              <div class="alert alert-danger">
                  {{ session()->get('error') }}
              </div>
              @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Ukuran</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="{{ route('ukuran.create') }}" class="btn btn-primary mb-2">(+) Tambah Ukuran</a>

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 5%">No</th>
                    <th>Nama Ukuran</th>
                    
                    <th style="width: 20%">Aksi</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($ukuran as $item)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_ukuran }}</td>
                        <td>
                          <a href="{{ route('ukuran.show', $item->id) }}" class="btn btn-sm btn-info" style ='float: left; margin-right: 5px'>Detail</a>
                          <a href="{{ route('ukuran.edit', $item->id) }}" class="btn btn-sm btn-primary" style ='float: left;'>Edit</a>
                          {{-- <form action="{{ route('ukuran.destroy', $item->id) }}" method="POST" style ='float: left; padding-left: 5px;'>
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ?')">Hapus</button>
          
                          </form> --}}
                        </td>
                      </tr>
                    @endforeach
                  
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@push('down-script')
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endpush
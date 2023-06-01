@extends('layouts.dashboard-admin')

@section('title','Halaman Detail Ukuran')

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
                <h3 class="card-title">Data Detail Ukuran</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <tbody>
                    <tr>
                      <th style="width: 400px">Nama Ukuran</th>
                      <td>{{ $item->nama_ukuran }}</td>
                    </tr>

                    <tr>
                        <th style="width: 400px">Ukuran 1</th>
                        <td>{{ $item->ukuran1 ?? 'Tidak Ada' }}</td>
                    </tr>
                    <tr>
                        <th style="width: 400px">Ukuran 2</th>
                        <td>{{ $item->ukuran2 ?? 'Tidak Ada' }}</td>
                    </tr>
                    <tr>
                        <th style="width: 400px">Ukuran 3</th>
                        <td>{{ $item->ukuran3 ?? 'Tidak Ada' }}</td>
                    </tr>
                    <tr>
                        <th style="width: 400px">Ukuran 4</th>
                        <td>{{ $item->ukuran4 ?? 'Tidak Ada' }}</td>
                    </tr>
                    <tr>
                        <th style="width: 400px">Ukuran 5</th>
                        <td>{{ $item->ukuran5 ?? 'Tidak Ada' }}</td>
                    </tr>
                    <tr>
                        <th style="width: 400px">Ukuran 6</th>
                        <td>{{ $item->ukuran6 ?? 'Tidak Ada' }}</td>
                    </tr>
                    <tr>
                        <th style="width: 400px">Ukuran 7</th>
                        <td>{{ $item->ukuran7 ?? 'Tidak Ada' }}</td>
                    </tr>
                    <tr>
                        <th style="width: 400px">Ukuran 8</th>
                        <td>{{ $item->ukuran8 ?? 'Tidak Ada' }}</td>
                    </tr>
                    <tr>
                        <th style="width: 400px">Ukuran 9</th>
                        <td>{{ $item->ukuran9 ?? 'Tidak Ada' }}</td>
                    </tr>
                    <tr>
                        <th style="width: 400px">Ukuran 10</th>
                        <td>{{ $item->ukuran10 ?? 'Tidak Ada' }}</td>
                    </tr>
                      
                  </tbody>
                  
                </table>
                <a href="{{ route('ukuran.index') }}" class="btn btn-primary mt-3">Kembali</a>

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
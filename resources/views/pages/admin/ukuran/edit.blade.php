@extends('layouts.dashboard-admin')

@section('title','Halaman Edit Ukuran')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Ukuran</h1>
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
    
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Form Edit Data Ukuran</h3>
                </div>
                <!-- /.card-header -->
                <form method="POST" action="{{ route('ukuran.update', $item->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama Ukuran</label>
                        <input type="text" class="form-control @error('nama_ukuran') is-invalid @enderror" value="{{ $item->nama_ukuran }}" name="nama_ukuran" placeholder="Nama Ukuran">
                       <div class="invalid-feedback">
                            Masukan Nama Ukuran
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ukuran 1</label>
                      <input type="text" class="form-control" value="{{ $item->ukuran1 }}" name="ukuran1" placeholder="Ukuran 1">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Ukuran 2</label>
                    <input type="text" class="form-control" value="{{ $item->ukuran2 }}" name="ukuran2" placeholder="Ukuran 2">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Ukuran 3</label>
                  <input type="text" class="form-control" value="{{ $item->ukuran3 }}" name="ukuran3" placeholder="Ukuran 3">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Ukuran 4</label>
                <input type="text" class="form-control" value="{{ $item->ukuran4 }}" name="ukuran4" placeholder="Ukuran 4">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Ukuran 5</label>
              <input type="text" class="form-control" value="{{ $item->ukuran5 }}" name="ukuran5" placeholder="Ukuran 5">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Ukuran 6</label>
            <input type="text" class="form-control" value="{{ $item->ukuran6 }}" name="ukuran6" placeholder="Ukuran 6">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Ukuran 7</label>
          <input type="text" class="form-control" value="{{ $item->ukuran7 }}" name="ukuran7" placeholder="Ukuran 7">
      </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Ukuran 8</label>
            <input type="text" class="form-control" value="{{ $item->ukuran8 }}" name="ukuran8" placeholder="Ukuran 8">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Ukuran 9</label>
          <input type="text" class="form-control" value="{{ $item->ukuran9 }}" name="ukuran9" placeholder="Ukuran 9">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Ukuran 10</label>
        <input type="text" class="form-control" value="{{ $item->ukuran10 }}" name="ukuran10" placeholder="Ukuran 10">
    </div>
                    
                </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
          
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

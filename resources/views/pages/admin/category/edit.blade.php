@extends('layouts.dashboard-admin')

@section('title','Halaman Tambah Kategori')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Kategori</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Kategori</li>
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
                  <h3 class="card-title">Form Edit Data Kategori</h3>
                </div>
                <!-- /.card-header -->
                <form method="POST" action="{{ route('kategori.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama Kategori</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ $category->nama }}" name="nama" placeholder="Nama Kategori">
                       <div class="invalid-feedback">
                            Masukan Nama Kategori
                        </div>
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

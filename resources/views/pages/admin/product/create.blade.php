@extends('layouts.dashboard-admin')

@section('title','Halaman Tambah Product')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Produk</li>
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
                  <h3 class="card-title">Form Tambah Data Produk</h3>
                </div>
                <!-- /.card-header -->
                <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Produk</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" name="nama" placeholder="Nama Produk">
                       <div class="invalid-feedback">
                            Masukan Nama Produk
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Kategori Produk</label>
                      <select name="categories_id" id="categories_id" class="form-control @error('categories_id') is-invalid @enderror" value="{{ old('categories_id') }}">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($category as $item)
                          <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                      </select>
                     <div class="invalid-feedback">
                          Silahkan Pilih Kategori
                      </div>
                  </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Stok</label>
                        <input type="number" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}" name="stok" placeholder="Stok">
                      <div class="invalid-feedback">
                            Masukan Stok
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Harga</label>
                      <input type="number" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" name="harga" placeholder="Harga">
                    <div class="invalid-feedback">
                          Masukan Harga
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Deskripsi Produk</label>
                      <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" value="{{ old('deskripsi') }}" id="editor"></textarea>
                      <div class="invalid-feedback">
                        Isikan Deskripsi Produk
                    </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ukuran Produk</label>
                      <select name="ukuran_id" id="ukuran_id" class="form-control" value="{{ old('ukuran_id') }}">
                        <option value="">-- Tidak Pilih Ukuran --</option>
                        @foreach ($ukuran as $uk)
                          <option value="{{ $uk->id }}">{{ $uk->nama_ukuran }}</option>
                        @endforeach
                      </select>
                     <div class="invalid-feedback">
                          Silahkan Ukuran
                      </div>
                  </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Link Shopee</label>
                      <input type="text" class="form-control @error('shopee') is-invalid @enderror" value="{{ old('shopee') }}" name="shopee" placeholder="Link Shopee">
                    <div class="invalid-feedback">
                          Masukan Link Shopee
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Link Tokopedia</label>
                      <input type="text" class="form-control @error('tokped') is-invalid @enderror" value="{{ old('tokped') }}" name="tokped" placeholder="Link Tokopedia">
                    <div class="invalid-feedback">
                          Masukan Link Tokopedia
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar Produk</label>
                      <div class="text-muted">Kamu Bisa Memilih Lebih dari Satu Gambar</div>
                      <input type="file" class="form-control @error('photos') is-invalid @enderror" name="photos[]" multiple="true">
                    <div class="invalid-feedback">
                          Masukan Gambar Produk
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

@push('down-script')
  <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace("editor");
  </script>
@endpush
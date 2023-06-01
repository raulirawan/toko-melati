@extends('layouts.dashboard-admin')

@section('title', 'Halaman Edit Product')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Produk</h1>
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
                        @if (session()->has('sukses'))
                            <div class="alert alert-success">
                                {{ session()->get('sukses') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Form Edit Data Produk</h3>
                            </div>
                            <!-- /.card-header -->
                            <form method="POST" action="{{ route('produk.update', $product->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Produk</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            value="{{ $product->nama }}" name="nama" placeholder="Nama Produk">
                                        <div class="invalid-feedback">
                                            Masukan Nama Produk
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Kategori Produk</label>
                                        <select name="categories_id" id="categories_id"
                                            class="form-control @error('categories_id') is-invalid @enderror"
                                            value="{{ old('categories_id') }}">
                                            <option value="{{ $product->categories_id }}">{{ $product->category->nama }}
                                            </option>
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
                                        <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                            value="{{ $product->stok }}" name="stok" placeholder="Stok">
                                        <div class="invalid-feedback">
                                            Masukan Stok
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Harga</label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                            value="{{ $product->harga }}" name="harga" placeholder="Stok">
                                        <div class="invalid-feedback">
                                            Masukan Harga
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Deskripsi Produk</label>
                                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="editor">{{ $product->deskripsi }}</textarea>
                                        <div class="invalid-feedback">
                                            Isikan Deskripsi Produk
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Link Shopee</label>
                                        <input type="text" class="form-control @error('shopee') is-invalid @enderror"
                                            value="{{ $product->shopee }}" name="shopee" placeholder="Link Shopee">
                                        <div class="invalid-feedback">
                                            Masukan Link Shopee
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Link Tokopedia</label>
                                        <input type="text" class="form-control @error('tokped') is-invalid @enderror"
                                            value="{{ $product->tokped }}" name="tokped" placeholder="Link Tokopedia">
                                        <div class="invalid-feedback">
                                            Masukan Link Tokopedia
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>

                        </div>

                        <div class="card mb-4">
                            <div class="card-body pb-5">
                                <div class="row">
                                    @foreach ($product->galleries as $gallery)
                                        <div class="col-md-3">
                                            <div class="gallery-container">
                                                <img src="{{ Storage::url($gallery->photos ?? '') }}" alt=""
                                                    class="w-100" />
                                                <div class="text-center">
                                                    <a href="{{ route('hapus.gambar', $gallery->id) }}"
                                                        class="btn btn-sm btn-danger btn-block">
                                                        Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="col-12">
                                        <form action="{{ route('upload.gambar') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="products_id" value="{{ $product->id }}">
                                            <input type="file" name="photos" id="file" style="display: none;"
                                                onchange="form.submit()" />
                                            <button type="button" class="btn btn-secondary btn-block mt-3"
                                                onclick="thisFileUpload()">
                                                Tambah Gambar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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

@push('down-style')
    <style>
        .card .gallery-container .delete-container {
            display: block;
            position: absolute;
            top: -10px;
            right: 0;
        }
    </style>
@endpush

@push('down-script')
    <script>
        function thisFileUpload() {
            document.getElementById("file").click();
        }
    </script>
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("editor");
    </script>
@endpush

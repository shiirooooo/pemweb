@extends('layouts.main')
@section('title', 'Tambah Menu')
@section('container')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('products.index') }}">Menu</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Tambah Menu</strong></div>
            </div>
        </div>
    </div>
    <div class="site-section">
        <div class="container">
            <h3 class="text-center mb-5">SILAHKAN TAMBAH MENU</h3>
            <div class="card p-5 mb-5">
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="menu1">Nama Menu</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" id="menu1" name="name" required>
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="#">Jenis Menu</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                    @if (old('category') == 'Makanan') checked @endif value="Makanan" name="category"
                                    required>Makanan
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input"
                                    @if (old('category') == 'Minuman') checked @endif value="Minuman" name="category">Minuman
                            </label>
                        </div>
                        @error('category')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="stok1">Stok</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror"
                            value="{{ old('stock') }}" id="stok1" name="stock" required>
                        @error('stock')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga1">Harga Menu</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price') }}" id="harga1" name="price" required>
                        @error('price')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gambar">Foto Menu</label>
                        <input type="file" accept=".jpg,.png,.jpeg" class="form-control-file border" id="gambar"
                            name="photo" required>
                        @error('photo')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div><br>
                    <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                    <button type="reset" class="btn btn-danger" name="reset">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.main')
@section('title', 'Edit Menu')
@section('container')
<h3 class="text-center mt-5 mb-5">Edit Menu {{ $product->name }}</h3>
<div class="card p-5 mb-5">
  <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <div class="form-group">
      <label for="menu1">Nama Menu</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" id="menu1" name="name" required>
      @error('name')
          <p class="text-danger">{{ $message }}</p>
      @enderror
    </div>
    <div class="form-group">
      <label for="#">Jenis Menu</label>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" @if(old('category', $product->category) == 'Makanan') checked @endif value="Makanan" name="category" required>Makanan
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" @if(old('category', $product->category) == 'Minuman') checked @endif value="Minuman" name="category">Minuman
        </label>
      </div>
      @error('category')
          <p class="text-danger">{{ $message }}</p>
      @enderror
     </div>
    <div class="form-group">
      <label for="stok1">Stok</label>
      <input type="number" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" id="stok1" name="stock">
      @error('stock')
          <p class="text-danger">{{ $message }}</p>
      @enderror
    </div>
    <div class="form-group">
      <label for="harga1">Harga Menu</label>
      <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" id="harga1" name="price">
      @error('price')
          <p class="text-danger">{{ $message }}</p>
      @enderror
    </div>
    <div class="form-group">
      <label for="gambar">Ganti Foto Menu</label>
      <br>
      <img class="mb-2" src="{{ asset($product->photo) }}" alt="" srcset="" style="max-width: 150px;">
      <input type="file" accept=".jpg,.png,.jpeg" class="form-control-file border" id="gambar" name="photo">
      @error('photo')
          <p class="text-danger">{{ $message }}</p>
      @enderror
    </div><br>
    <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
    <button type="reset" class="btn btn-danger" name="reset">Hapus</button>
  </form>
</div>
@endsection

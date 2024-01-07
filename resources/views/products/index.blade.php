@extends('layouts.main')
@section('title', 'Daftar Menu')
@section('container')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('products.index') }}">Menu</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Daftar Menu</strong></div>
            </div>
        </div>
    </div>
    <div class="site-section">
        <div class="container">
            <div class="row">

                <div class="col-md-9 order-2">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="float-md-left">
                                <h2 class="text-black h5">Menu</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        @forelse ($products as $product)
                            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                <div class="block-4 text-center border">
                                    <figure class="block-4-image">
                                        <img src="{{ asset($product->photo) }}" alt="Image placeholder" class="img-fluid" />
                                    </figure>
                                    <div class="block-4-text p-4">
                                        <h3 class="text-primary font-weight-bold">{{ $product->name }}</h3>
                                        <p>
                                        <p class="text-secondary font-weight-bold mb-0">Rp.
                                            {{ number_format($product->price) }}</p>
                                        <p class="badge bg-light mb-0">Stock: {{ $product->stock }}</p>
                                        </p>
                                        @admin
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('products.edit', $product->id) }}" type="button"
                                                    class="btn btn-warning btn-sm"><span class="icon icon-pencil"></span> Edit</a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm"><span
                                                            class="icon icon-trash"></span> Hapus</button>
                                                </form>
                                            </div>
                                        @endadmin
                                        @user
                                            @if ($product->stock > 0)
                                                <form action="{{ route('add-to-cart', $product->id) }}" method="post">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-success btn-sm btn-block mb-2">PESAN</button>
                                                </form>
                                            @else
                                                <button class="btn btn-secondary btn-sm btn-block mb-2" disabled>STOK
                                                    HABIS</button>
                                            @endif
                                        @enduser
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12 mt-4">
                                <div class="alert alert-info text-center">
                                    <h3>Menu isn't Available</h3>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-3 order-1 mb-5 mb-md-0">
                    <div class="border p-4 rounded mb-4">
                        <h3 class="mb-3 h6 text-uppercase text-black d-block">
                            Kategori
                        </h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1">
                                <a href="?category=" class="d-flex"><span>Semua</span>
                                    <span class="text-black ml-auto">({{ $total }})</span></a>
                            </li>
                            <li class="mb-1">
                                <a href="?category=Makanan" class="d-flex"><span>Makanan</span>
                                    <span class="text-black ml-auto">({{ $foods }})</span></a>
                            </li>
                            <li class="mb-1">
                                <a href="?category=Minuman" class="d-flex"><span>Minuman</span>
                                    <span class="text-black ml-auto">({{ $drinks }})</span></a>
                            </li>
                        </ul>
                    </div>
                    @admin
                    <div class="border p-4 rounded mb-4">
                        <h3 class="mb-3 h6 text-uppercase text-black d-block">
                            Admin Menu
                        </h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1">
                                <a href="{{ route('products.create') }}" class="btn btn-primary btn-block"><span
                                        class="icon icon-plus"></span> Tambah Menu</a>
                            </li>
                        </ul>
                    </div>
                    @endadmin
                </div>
            </div>
        </div>
    </div>
@endsection

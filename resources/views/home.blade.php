@extends('layouts.main')
@section('title', 'Home')
@section('container')

<div class="site-blocks-cover" style="background-image: url({{ asset('images/slider.jpg') }});" data-aos="fade">
    <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
            <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
                <h1 class="mb-2">Manjakan Diri Anda dengan Kelezatan yang Manis!</h1>
                <div class="intro-text text-center text-md-left">
                    <p class="mb-4">Selamat datang di toko makanan penutup kami, di mana setiap gigitan adalah sebuah perayaan!</p>
                    <p>
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">Lihat Menu</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section site-blocks-2">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                <a class="block-2-item" href="{{ route('products.index') }}">
                    <figure class="image" style="max-height: 350px;">
                        <img src="{{ asset('images/menu.jpg') }}" alt="" class="img-fluid">
                    </figure>
                    <div class="text">
                        <span class="text-uppercase">Daftar</span>
                        <h3>Menu</h3>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
                <a class="block-2-item" href="{{ route('my-orders') }}">
                    <figure class="image" style="max-height: 350px;">
                        <img src="{{ asset('images/orders.jpg') }}" alt="" class="img-fluid">
                    </figure>
                    <div class="text">
                        <span class="text-uppercase">Lihat</span>
                        <h3>Pesanan</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="site-section block-3 site-blocks-2 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Menu Terbaru</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nonloop-block-3 owl-carousel">
                    @foreach ($products as $product)
                    <div class="item">
                        <div class="block-4 text-center">
                            <figure class="block-4-image">
                                <img src="{{ asset($product->photo) }}" alt="Image placeholder" class="img-fluid">
                            </figure>
                            <div class="block-4-text p-4">
                                <h3>{{ $product->name }}</h3>
                                <p class="text-primary font-weight-bold">Rp. {{ number_format($product->price) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

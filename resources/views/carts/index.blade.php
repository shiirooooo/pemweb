@extends('layouts.main')
@section('title', 'Keranjang')
@section('container')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('home') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Keranjang</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="site-blocks-table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Nama Menu</th>
                                <th class="product-price">Harga</th>
                                <th class="product-quantity">Jumlah</th>
                                <th class="product-total">Subtotal</th>
                                <th class="product-remove">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @forelse ($carts as $cart)
                                <tr>
                                    <td class="product-thumbnail">
                                        <img src="{{ asset($cart->product->photo) }}" alt="Image" class="img-fluid">
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black">{{ $cart->product->name }}</h2>
                                    </td>
                                    <td>Rp. {{ number_format($cart->product->price) }}</td>
                                    <form action="{{ route('update-cart', $cart->id) }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <td>
                                            <div class="input-group mb-3" style="max-width: 120px;">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-primary js-btn-minus"
                                                        type="button">&minus;</button>
                                                </div>
                                                <input type="text" name="quantity" class="form-control text-center"
                                                    value="{{ $cart->quantity }}" placeholder=""
                                                    aria-label="Example text with button addon"
                                                    aria-describedby="button-addon1">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-primary js-btn-plus"
                                                        type="button">&plus;</button>
                                                </div>
                                            </div>

                                        </td>
                                        <td>Rp. {{ number_format($cart->product->price * $cart->quantity) }}</td>
                                        <td>
                                            <button type="submit" class="btn btn-primary btn-sm mb-2">
                                                <span class="icon icon-update"></span>
                                            </button>
                                            <a href="{{ route('remove-from-cart', $cart->id) }}"
                                                class="btn btn-danger btn-sm mb-2">
                                                <span class="icon icon-trash"></span>
                                            </a>
                                        </td>
                                    </form>
                                </tr>
                                @php
                                    $total += $cart->product->price * $cart->quantity;
                                @endphp
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Keranjang Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">Rp. {{ number_format($total) }}</strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-lg py-3 btn-block"
                                        onclick="window.location='{{ route('checkout') }}'"
                                        @if ($cartCount == 0) disabled @endif>Pesan Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

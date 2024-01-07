@extends('layouts.main')
@section('title', 'Checkout')
@section('container')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('home') }}">Home</a> <span class="mx-2 mb-0">/</span> <a
                        href="{{ route('cart') }}">Keranjang</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Checkout</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <form method="POST" action="{{ route('order') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-5 mb-md-0">
                        <h2 class="h3 mb-3 text-black">Detail Pemesan</h2>
                        <div class="p-3 p-lg-5 border">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="firstName" class="text-black">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="firstName" placeholder="Nama Lengkap"
                                        value="{{ old('name', auth()->user()->name) }}" required>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="phone_number" class="text-black">Nomor Telepon</label>
                                    <input type="number" name="phone_number"
                                        class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                                        placeholder="08xxxxxxxx"
                                        value="{{ old('phone_number', auth()->user()->phone_number) }}" required>
                                    @error('phone_number')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="address" class="text-black">Alamat Lengkap</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="3"
                                        required>{{ old('address', auth()->user()->address) }}</textarea>
                                    @error('address')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Pesanan</h2>
                                <div class="p-3 p-lg-5 border">
                                    <table class="table site-block-order-table mb-5">
                                        <thead>
                                            <th>Menu</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($carts as $cart)
                                                <tr>
                                                    <td>{{ $cart->product->name }} <strong class="mx-2">x</strong>
                                                        {{ $cart->quantity }}</td>
                                                    <td>Rp. {{ number_format($cart->product->price * $cart->quantity) }}
                                                    </td>
                                                </tr>
                                                @php
                                                    $total += $cart->product->price * $cart->quantity;
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                                <td class="text-black font-weight-bold"><strong>Rp.
                                                        {{ number_format($total) }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg py-3 btn-block">Pesan</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

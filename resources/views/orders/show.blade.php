@extends('layouts.main')
@section('title', 'Pesanan ' . $order->invoice)
@section('css')
    <style>

        #order-section #order-heading {
            background-color: #edf4f7;
            position: relative;
            border-top-left-radius: 25px;
            border-top-right-radius: 25px;
            max-width: 800px;
            padding-top: 20px;
            margin: 30px auto 0px;
        }

        #order-section #order-heading .text-uppercase {
            font-size: 0.9rem;
            color: #777;
            font-weight: 600;
        }

        #order-section #order-heading .h4 {
            font-weight: 600;
        }

        #order-section #order-heading .h4+div p {
            font-size: 0.8rem;
            color: #777;
        }

        #order-section .close {
            padding: 10px 15px;
            background-color: #777;
            border-radius: 50%;
            position: absolute;
            right: -15px;
            top: -20px;
        }

        #order-section .wrapper {
            padding: 0px 50px 50px;
            max-width: 800px;
            margin: 0px auto 40px;
            border-bottom-left-radius: 25px;
            border-bottom-right-radius: 25px;
            background-color: #fcfcfc;
        }

        #order-section .table th {
            border-top: none;
        }

        #order-section .table thead tr.text-uppercase th {
            font-size: 0.8rem;
            padding-left: 0px;
            padding-right: 0px;
        }

        #order-section .table tbody tr th,
        #order-section .table tbody tr td {
            font-size: 0.9rem;
            padding-left: 0px;
            padding-right: 0px;
            padding-bottom: 5px;
        }

        #order-section .list div b {
            font-size: 0.8rem;
        }

        #order-section .list .order-item {
            font-weight: 600;
            color: #6db3ec;
        }

        #order-section .list:hover {
            background-color: #f4f4f4;
            cursor: pointer;
            border-radius: 5px;
        }

        #order-section label {
            margin-bottom: 0;
            padding: 0;
            font-weight: 900;
        }

        #order-section button.btn {
            font-size: 0.9rem;
            background-color: #66cdaa;
        }

        #order-section button.btn:hover {
            background-color: #5cb99a;
        }

        #order-section .price {
            color: #5cb99a;
            font-weight: 700;
        }

        #order-section p.text-justify {
            font-size: 0.9rem;
            margin: 0;
        }

        #order-section .row {
            margin: 0px;
        }

        #order-section .subscriptions {
            border: 1px solid #ddd;
            border-left: 5px solid #ffa500;
            padding: 10px;
        }

        #order-section .subscriptions div {
            font-size: 0.9rem;
        }

        @media(max-width: 425px) {
            #order-section .wrapper {
                padding: 20px;
            }

            #order-section {
                font-size: 0.85rem;
            }

            #order-section .subscriptions div {
                padding-left: 5px;
            }

            #order-section img+label {
                font-size: 0.75rem;
            }

        }
    </style>
@endsection
@section('container')
<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        @admin
        <div class="col-md-12 mb-0"><a href="{{ route('orders') }}">Pesanan Pelanggan</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{ $order->invoice }}</strong></div>
        @endadmin
        @user
        <div class="col-md-12 mb-0"><a href="{{ route('my-orders') }}">Pesanan Saya</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{ $order->invoice }}</strong></div>
        @enduser
      </div>
    </div>
</div>
    <div class="mt-5" id="order-section">
        <div class="d-flex flex-column justify-content-center align-items-center" id="order-heading">
            <div class="text-uppercase">
                <p>Detail Pesanan</p>
            </div>
            <div class="h4">{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('l, d F Y H:i') }}</div>
            <div class="pt-1">
                <p>Pesanan {{ $order->invoice }}</p>
            </div>
        </div>
        <div class="wrapper">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr class="text-uppercase text-muted">
                            <th scope="col">Produk</th>
                            <th scope="col" class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $product)
                        <tr>
                            <td scope="row">
                                <div class="d-flex justify-content-start align-items-center list py-1">
                                    <div><b>{{ $product->quantity }}x</b></div>
                                    <div class="mx-3">
                                        <img src="{{ asset($product->photo) }}"
                                            alt="apple" class="rounded-circle" width="30" height="30">
                                    </div>
                                    <div class="order-item">{{ $product->product_name }}</div>
                                </div>
                            </td>
                            <td class="text-right"><b>Rp. {{ number_format($product->price * $product->quantity) }}</b></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pt-2 border-bottom"></div>
            <div class="d-flex justify-content-start align-items-center pl-3 py-3 mb-4 border-bottom">
                <div class="text-muted">
                    Total
                </div>
                <div class="ml-auto h5">
                    Rp. {{ number_format($order->total) }}
                </div>
            </div>
            <div class="row border rounded p-1">
                <div class="col-md-6 py-3">
                    <div class="d-flex flex-column align-items start">
                        <b>Alamat Pengiriman</b>
                        <p class="text-justify pt-2">{{ $order->name }}</p>
                        <p class="text-justify">{{ $order->address }}</p>
                        <p class="text-justify">{{ $order->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

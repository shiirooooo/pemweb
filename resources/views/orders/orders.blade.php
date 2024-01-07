@extends('layouts.main')
@admin
    @section('title', 'Pesanan Pelanggan')
@endadmin
@user
    @section('title', 'Pesanan Saya')
@enduser
@section('container')
<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        @admin
        <div class="col-md-12 mb-0"><a href="{{ route('orders') }}">Pesanan Pelanggan</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Daftar Pesanan</strong></div>
        @endadmin
        @user
        <div class="col-md-12 mb-0"><a href="{{ route('my-orders') }}">Pesanan Saya</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Daftar Pesanan</strong></div>
        @enduser
      </div>
    </div>
</div>
<div class="site-section">
    <div class="container">
        <div class="site-blocks-table">
          <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID Pesanan</th>
                    <th>Tanggal Pesan</th>
                    <th>Total</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->invoice }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d F Y H:i') }}</td>
                    <td>Rp. {{ number_format($order->total) }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm"><span class="icon icon-search"></span> Detail</a>
                        @admin
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"><span class="icon icon-trash"></span> Hapus</button>
                        </form>
                        @endadmin
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada pesanan</td>
                </tr>
                @endforelse
            </tbody>
          </table>
    </div>
</div>
@endsection

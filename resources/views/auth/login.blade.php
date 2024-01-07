@extends('layouts.main')
@section('title', 'Login')
@section('container')
<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="{{ route('home') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Login</strong></div>
      </div>
    </div>
</div>
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-12 col-md-4">
            <form class="form-signin" method="POST" action="{{ route('authenticate') }}">
                @csrf
                <div class="text-center mb-5">
                    <h1 class="h3 mb-3 font-weight-bold">Login</h1>
                </div>

                <div class="form-label-group mb-3">
                    <input type="email" name="email" id="inputEmail"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Alamat Email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <p class="text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-label-group mb-3">
                    <input type="password" name="password" id="inputPassword"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Kata Sandi"
                        required>
                    @error('password')
                        <p class="text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block mb-2" type="submit">LOGIN</button>
                <div class="mb-3 text-center">
                  <small><a href="{{ route('register') }}" class="text-dark">Belum Punya Akun? Buat Akun Anda!</a></small>
                </div>
            </form>
        </div>
    </div>
@endsection

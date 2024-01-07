@extends('layouts.main')
@section('title', 'Register')
@section('container')
<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="{{ route('home') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Register</strong></div>
      </div>
    </div>
</div>
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-12 col-md-4">
            <form class="form-signin" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="text-center mb-5">
                    <h1 class="h3 mb-3 font-weight-bold">Buat Akun</h1>
                </div>

                <div class="form-label-group mb-3">
                    <input type="text" name="name" id="inputName"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <p class="text text-danger">{{ $message }}</p>
                    @enderror
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
                    <select name="gender" id="inputGender" required class="form-control @error('gender') is-invalid @enderror">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    @error('gender')
                        <p class="text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-label-group mb-3">
                    <input type="date" name="date_of_birth" id="inputDateOfBirth"
                        class="form-control @error('date_of_birth') is-invalid @enderror" placeholder="Tanggal Lahir" value="{{ old('date_of_birth') }}"
                        required>
                    @error('date_of_birth')
                        <p class="text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-label-group mb-3">
                    <input type="number" name="phone_number" id="inputPhoneNumber"
                        class="form-control @error('phone_number') is-invalid @enderror" placeholder="Nomor Telepon" value="{{ old('phone_number') }}"
                        required>
                    @error('phone_number')
                        <p class="text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-label-group mb-3">
                    <input type="text" name="address" id="inputAddress"
                        class="form-control @error('address') is-invalid @enderror" placeholder="Alamat Lengkap" value="{{ old('address') }}"
                        required>
                    @error('address')
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

                <div class="form-label-group mb-3">
                    <input type="password" name="password_confirmation" id="inputPasswordConfirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi Kata Sandi"
                        required>
                    @error('password_confirmation')
                        <p class="text text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <button class="btn btn-lg btn-primary btn-block mb-2" type="submit">Daftar</button>
                <div class="mb-3 text-center">
                  <small><a href="{{ route('login') }}" class="text-dark">Sudah Mempunyai Akun? Login!</a></small>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Akun</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('TampilAkun') }}">Akun</a></li>
                        <li class="breadcrumb-item active">Tambah Akun</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Input Data Akun</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('buatAkun') }}" method="post">
                                @csrf
                                <!-- Username -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Username</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Checkbox Show Password -->
                                <input type="checkbox" onclick="togglePassword()"> Show Password
                                <br>

                                <!-- Level -->
                                <div class="mb-3">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-olive @if(old('level') == 'admin') active @endif">
                                            <input type="radio" name="level" id="option_b1" autocomplete="off" value="admin" @if(old('level') == 'admin') checked @endif required>admin
                                        </label>
                                        <label class="btn bg-olive @if(old('level') == 'karyawan') active @endif">
                                            <input type="radio" name="level" id="option_b2" autocomplete="off" value="karyawan" @if(old('level') == 'karyawan') checked @endif required>karyawan
                                        </label>
                                    </div>
                                    @error('level')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('TampilAkun') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
@endsection

@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Data Akun</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('TampilAkun') }}">Akun</a></li>
                        <li class="breadcrumb-item active">Edit Akun</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        @if ($errors->has('username'))
            <div class="alert alert-danger">
                {{ $errors->first('username') }}
            </div>
        @endif
    </section>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Ubah Data Akun</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('UpdateAkun', $user->Id_User) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="Username" class="form-label">Username</label>
                                    <input type="text" class="form-control" value="{{ $user->Username }}" id="Username"
                                        name="Username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Password" class="form-label">Password</label>
                                    <input type="password" class="form-control" value="{{ $user->Password }}" id="Password"
                                        name="Password" required>
                                </div>
                                <input type="checkbox" onclick="togglePassword()"> Show Password
                                <br>
                                <button type="submit" class="btn btn-primary">Edit</button>
                                <a href="{{ route('TampilAkun') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById("Password");
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        }
    </script>
@endsection

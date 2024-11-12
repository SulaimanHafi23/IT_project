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
                        <li class="breadcrumb-item"><a href="{{route('Beranda')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('TampilAkun')}}">Akun</a></li>
                        <li class="breadcrumb-item active">Tambah Akun</li>
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
                            <h3 class="card-title">Form Input Data Akun</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('buatAkun') }}" method="post">
                                @csrf
                                <!-- Username -->
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <!-- Checkbox Show Password -->
                                <input type="checkbox" onclick="togglePassword()"> Show Password
                                <br>

                                <!-- Level -->
                                <div class="mb-3">
                                    <label class="form-label">Level</label><br>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-olive active">
                                            <input type="radio" name="level" id="option_b1" autocomplete="off"
                                                value="admin" required>admin
                                        </label>
                                        <label class="btn bg-olive">
                                            <input type="radio" name="level" id="option_b2" autocomplete="off"
                                                value="karyawan" required>karyawan
                                        </label>
                                    </div>
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
            const passwordField = document.getElementById("password"); // Mengacu ke ID "password"
            if (passwordField.type === "password") {
                passwordField.type = "text"; // Menampilkan password
            } else {
                passwordField.type = "password"; // Menyembunyikan password
            }
        }
    </script>
@endsection

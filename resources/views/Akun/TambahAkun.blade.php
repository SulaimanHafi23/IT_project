@extends('layouts.SideBar')
@section('content')
<div class="container mt-2">
    <h2 class="mb-4">Form Input Data Akun</h2>
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
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="level" id="admin" value="admin" required>
                <label class="form-check-label" for="admin">Admin</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="level" id="karyawan" value="karyawan" required>
                <label class="form-check-label" for="karyawan">Karyawan</label>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('TampilAkun') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
<script src="{{ asset('js/scripts.js') }}"></script>
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

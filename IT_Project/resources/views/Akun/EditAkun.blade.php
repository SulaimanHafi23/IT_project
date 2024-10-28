@extends('layouts.SideBar')
@section('content')
    <div class="container mt-2">
        <h2 class="mb-4">Form Ubah Data Akun</h2>
        <form action="{{ route('UpdateAkun', $user->Id_User) }}" method="post">
            @csrf
            @method('PUT')

            <!-- Username -->
            <div class="mb-3">
                <label for="Username" class="form-label">Username</label>
                <input type="text" class="form-control" value="{{ $user->Username }}" id="Username" name="Username"
                    required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password" class="form-control" value="{{ $user->Password }}" id="Password" name="Password"
                    required>
            </div>

            <!-- Toggle Password Checkbox -->
            <input type="checkbox" onclick="togglePassword()"> Show Password
            <br>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Edit</button>
            <a href="{{ route('TampilAkun') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById("Password");
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        }
    </script>
@endsection

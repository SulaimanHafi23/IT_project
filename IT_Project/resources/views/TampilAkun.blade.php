<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap 5.3 Sidebar with User Profile</title>
  <!-- Bootstrap 5.3 CSS -->
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    .sidebar {
      height: 100vh;
      width: 250px;
      background-color: #212529;
      padding: 20px;
      color: white;
    }

    .sidebar .nav-link {
      color: white;
      font-size: 1.1rem;
    }

    .sidebar .nav-link.active {
      background-color: #0d6efd;
    }

    .sidebar .nav-link:hover {
      background-color: #495057;
    }

    .sidebar .nav-link i {
      margin-right: 10px;
    }

    .profile {
      position: absolute;
      bottom: 20px;
      width: 40%;
      color: white;
      padding-left: 15px;
    }

    .profile img {
      border-radius: 50%;
      width: 40px;
      height: 40px;
      object-fit: cover;
      margin-right: 10px;
    }

    .profile .dropdown-toggle {
      color: white;
      border: none;
      font-weight: bold;
      display: flex;
      align-items: center;
    }

    .profile .dropdown-toggle::after {
      margin-left: 10px;
    }
  </style>
</head>
<body>
    <div class=" d-flex flex-row">
        <!-- Sidebar -->
  <div class="sidebar d-flex flex-column p-3">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <i class="bi bi-bootstrap" style="font-size: 1.5rem;"></i>
      <span class="fs-4 ms-2">Hafidzah</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="{{ route('Beranda') }}" class="nav-link">
              <i class="bi bi-speedometer2"></i>
              Beranda
            </a>
          </li>
          <li>
            <a href="{{ route('Admin') }}" class="nav-link">
              <i class="bi bi-people"></i>
              Admin
            </a>
          </li>
          <li>
            <a href="{{ route('Akun') }}" class="nav-link active">
              <i class="bi bi-bi bi-person-circle"></i>
              Akun
            </a>
          </li>
          <li>
            <a href="{{ route('Karyawan') }}" class="nav-link">
              <i class="bi bi-people"></i>
              Karyawan
            </a>
          </li>
          <li>
            <a href="{{ route('Penjualan') }}" class="nav-link">
              <i class="bi bi-table"></i>
              Penjualan
            </a>
          </li>
          <li>
            <a href="{{ route('Produk') }}" class="nav-link">
              <i class="bi bi-grid"></i>
              Produk
            </a>
          </li>
          <li>
            <a href="Laporan" class="nav-link">
              <i class="bi bi-journal"></i>
              Laporan
            </a>
          </li>
    </ul>
    <hr><br>
    <hr style="margin-bottom: 0px;">
    <div class="profile d-flex align-items-center" style="padding-bottom:5px;">
      <img src="https://via.placeholder.com/40" alt="profile">
      <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          mdo
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
  {{-- content --}}
  <div class="container mt-5">
    <h1 style="text-align: center">Halaman Akun</h1>
    <hr>
    <div style="align-content: center">
        <a href="{{route('TambahAkun')}}">
            <button class="btn btn-primary" type="button">Tambah Data</button>
        </a>
    </div>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">username</th>
                <th scope="col">Level</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($akun as $no => $dataakun)
              <tr>
                  <td>{{ $no + 1 }}</td>
                  <td>{{ $dataakun->Username }}</td>
                  <td>{{ $dataakun->level }}</td>
                  <td>
                    <a href="{{route('EditAkun', $dataakun->Id_Akun)}}">
                      <button type="button" class="btn btn-warning">
                          <i class="bi bi-pencil-square"></i>
                      </button>
                    </a>
                    <form action="{{route('DeleteAkun', $dataakun->Id_Akun)}}" method="POST" style="display: inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
  </div>

    </div>

  <!-- Bootstrap 5.3 JS Bundle with Popper -->
  <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>

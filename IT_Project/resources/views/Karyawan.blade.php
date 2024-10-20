@extends('layouts.SideBar')
@section('SideBar')
<li>
  <a href="{{ route('Beranda') }}" class="nav-link ">
      <i class="bi bi-speedometer2"></i>
      Beranda
  </a>
</li>
<li>
  <a href="{{ route('TampilAkun') }}" class="nav-link ">
      <i class="bi bi-bi bi-person-circle"></i>
      Akun
  </a>
</li>
<li>
  <a href="{{ route('Karyawan') }}" class="nav-link active">
      <i class="bi bi-people"></i>
      Karyawan
  </a>
</li>
<li>
  <a href="{{ route('TampilPenjualan') }}" class="nav-link">
      <i class="bi bi-table"></i>
      Penjualan
  </a>
</li>
<li>
  <a href="{{ route('produks.index') }}" class="nav-link">
      <i class="bi bi-grid"></i>
      Produk
  </a>
</li>
<li>
  <a href="{{ route('TampilLaporan') }}" class="nav-link">
      <i class="bi bi-journal"></i>
      Laporan
  </a>
</li>
</ul>
@endsection

@section('content')
<div class="container mt-5">
  <h1 style="text-align: center">Halaman Karyawan</h1>
  <hr>

</div>
@endsection
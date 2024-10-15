@extends('layouts.app')

@section('content')
    <h1>{{ $produk->name }}</h1>
    <p>Harga: {{ $produk->price }}</p>
    <p>Deskripsi: {{ $produk->description }}</p>
    <h2>Ulasan</h2>
    <ul>
        @foreach ($produk->ulasans as $ulasan)
            <li>{{ $ulasan->comment }}</li>
        @endforeach
    </ul>
@endsection

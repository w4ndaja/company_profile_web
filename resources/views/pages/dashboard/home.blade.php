@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
<div class="container py-3">
    <div class="jumbotron">
        <h1 class="display-4">Selamat datang di situs {{config('theme.name')}} !</h1>
        <p class="lead bg-light px-3 rounded">Anda dapat mengubah dan menyesuaikan tampilan, halaman, artikel dan lainnya dari sini.</p>
        <hr class="my-4">
        <h3 class="px-3 py-1 bg-secondary text-light rounded">Silahkan menggunakan menu navigasi untuk penyesuaian situs.</h3>
      </div>
</div>
@endsection

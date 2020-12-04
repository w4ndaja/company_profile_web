@extends('layouts.dashboard')
@section('title', 'Initialization')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 py-5">
            <div class="card">
                <div class="card-header bg-success text-white h3">Inisialisasi Sukses</div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">Superadmin User Berhasil dibuat, silahkan login kembali dengan</li>
                        <li class="list-group-item">username : superadmin</li>
                        <li class="list-group-item">password : password</li>
                        <li class="list-group-item"><a href="{{ route('login') }}" class="btn btn-info">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
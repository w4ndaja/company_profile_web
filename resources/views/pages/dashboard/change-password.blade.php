@extends('layouts.dashboard')
@section('title', 'Ganti Password')
@section('content')
<div class="container pt-3">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Ganti Password</h3>
                </div>
                <form action="{{ route('attempt-change-password') }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label col-md-4">Password Lama</label>
                            <div class="col-md-8">
                                <input type="password" name="old_password" class="form-control @error('old_password') border-danger @enderror">
                                @error('old_password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-4">Password Baru</label>
                            <div class="col-md-8">
                                <input type="password" name="password" class="form-control @error('password') border-danger @enderror">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-4">Konfirmasi Password Baru</label>
                            <div class="col-md-8">
                                <input type="password" name='password_confirmation' class="form-control @error('password_confirmation') border-danger @enderror">
                                @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end"><button type="submit" class="btn btn-warning">Ganti</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.dashboard')
@section('title', 'Masuk')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center py-5">
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="card">
                    <div class="card-header h3 text-center text-light bg-dark"><strong>Login</strong></div>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row form-group">
                                <label class="col-form-label col-md-4">Username</label>
                                <div class="col-md-8">
                                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" class="form-control @error('username') border-danger @enderror">
                                    @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-form-label col-md-4">Password</label>
                                <div class="col-md-8">
                                    <input type="password" name="password" placeholder="Password" class="form-control @error('password') border-danger @enderror">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end bg-dark">
                            <button type="submit" class="btn btn-secondary text-light">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
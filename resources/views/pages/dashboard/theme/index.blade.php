@extends('layouts.dashboard')
@section('title', 'Pengaturan Situs')
@section('content')
<div class="container py-3">
    <div class="row col-lg-3 col-md-5">
        <div class="card">
            <div class="card-header text-center py-1 bg-dark text-light">
                <h3 class="m-0">Logo Situs</h3>
            </div>
            <form action="{{ route('theme.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="card-body">
                    @if($theme->logo)
                    <div id="preview-logo" onclick="openFile('#logo')"><img src="{{ asset($theme->logo) }}" alt="Logo" class="shadow-sm rounded w-100"></div>
                    @else
                    <div onclick="openFile('#logo')" class="rounded shadow-sm d-flex justify-content-center align-items-center w-100 bg-white @error('logo') border-danger @enderror" id="preview-logo" style="min-height:100px">
                        <strong class="text-dark">...Logo...</strong>
                    </div>
                    @endif
                    @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                    <input id="logo" type="file" name="logo" class="my-2 w-100" onchange="previewLogo(this, '#preview-logo', '100%', '100%')">
                    <button type="submit" class="btn btn-secondary btn-sm">Ganti</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
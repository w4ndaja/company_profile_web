@extends('layouts.dashboard')
@section('title', 'Pengaturan Situs')
@section('content')
<div class="container py-3">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-header text-center py-1 bg-dark text-light">
                    <h3 class="m-0">Informasi Situs</h3>
                </div>
                <form action="{{ route('theme.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <x-input name="name" label="Nama Situs"></x-input>
                        <div class="row form-group">
                            <label class="col-form-label col-md-4">Logo Situs</label>
                            <div class="col-md-8">
                                @if($theme->logo)
                                <div id="preview-logo" onclick="openFile('#logo')"><img src="{{ asset($theme->logo) }}" alt="Logo" class="btn btn-secondary shadow-sm rounded border w-100"></div>
                                @else
                                <div onclick="openFile('#logo')" class="btn btn-secondary p-0 rounded border shadow-sm d-flex justify-content-center align-items-center w-100 @error('logo') border-danger @enderror" id="preview-logo" style="min-height:100px">
                                    <strong class="text-dark">...Logo...</strong>
                                </div>
                                @endif
                                <input id="logo" type="file" name="logo" class="d-none my-2 w-100" onchange="previewLogo(this, '#preview-logo', '100%', '100%')">
                                @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-secondary btn-sm">Ganti</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

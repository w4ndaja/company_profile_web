@extends('layouts.dashboard')
@push('heads')
<link rel="stylesheet" href="{{asset('css/styles.css')}}">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    var editor = $('#editor')
    var editorFooter = $('#editor-footer')
    editor.summernote();
    editorFooter.summernote();
    $('#home-form').submit(e => {
        e.preventDefault()
        $('[name="content"]').val(editor.summernote('code'))
        e.target.submit()
    });
    $('#footer-form').submit(e => {
        e.preventDefault()
        $('[name="footer"]').val(editorFooter.summernote('code'))
        e.target.submit()
    });
</script>
@endpush
@section('title', 'Pengaturan Situs')
@section('content')
<div class="container py-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center py-1 bg-dark text-light">
                    <h3 class="m-0">Informasi Situs</h3>
                </div>
                <form action="{{ route('theme.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <x-input name="name" label="Nama Situs" :value="$theme->name"></x-input>
                        <div class="row form-group">
                            <label class="col-form-label col-md-4">Logo Situs</label>
                            <div class="col-md-8">
                                @if(Storage::disk('public')->exists($theme->logo))
                                <div id="preview-logo" onclick="openFile('#logo')"><img src="{{ asset($theme->logo) }}" alt="Logo" class="btn btn-light shadow-sm rounded border w-100"></div>
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
<div class="container-fluid">
    <div class="card">
        <form action="{{route('home-theme.update')}}" method="post" id="home-form">
            @csrf
            @method('patch')
            <input type="hidden" name="content">
            <div class="card-header bg-dark text-light d-flex justify-content-between px-3 py-1">
                <h4>Tampilan Beranda</h4>
                <button type="submit" class="btn btn-sm btn-secondary my-auto">Simpan</button>
            </div>
            <div class="card-body" id="editor">
                {!!$theme->home!!}
            </div>
        </form>
    </div>
</div>
<div class="container-fluid">
    <div class="card">
        <form action="{{route('footer-theme.update')}}" method="post" id="footer-form">
            @csrf
            @method('patch')
            <input type="hidden" name="footer">
            <div class="card-header bg-dark text-light d-flex justify-content-between px-3 py-1">
                <h4>Footer</h4>
                <button type="submit" class="btn btn-sm btn-secondary my-auto">Simpan</button>
            </div>
            <div class="card-body" id="editor-footer">
                {!!$theme->footer!!}
            </div>
        </form>
    </div>
</div>
@endsection

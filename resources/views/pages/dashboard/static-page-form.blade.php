@extends('layouts.dashboard')
@section('title', $title)
@push('heads')
<link rel="stylesheet" href="{{asset('css/styles.css')}}">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    var editor = $('#editor')
    editor.summernote({height:'500'});
    $('#page-form').submit(e => {
        e.preventDefault()
        $('[name="content"]').val(editor.summernote('code'))
        e.target.submit()
    });
</script>
@endpush
@section('content')
<form action="{{$action}}" method="post" id="page-form" enctype="multipart/form-data">
    @csrf
    @method($method)
    <div class="container pt-3">
        <div class="card">
            <div class="card-header bg-dark text-light d-flex justify-content-between px-2 py-1">
                <h4>{{$title}}</h4>
            </div>
            <div class="card-body">
                <input type="hidden" name="content">
                <div class="row form-group">
                    <label class="col-form-label col-lg-4">Gambar Utama</label>
                    <div class="col-lg-8">
                        <div onclick="openFile('#thumb-input')" class="btn rounded shadow-sm d-flex justify-content-center align-items-center bg-light border-secondary @error('thumb')  border-danger @enderror" style="width:256px;height:256px;overflow:hidden" id="thumb-preview">
                            @if(Storage::disk('public')->exists($page->thumb))
                            <img src="{{asset($page->thumb)}}" alt="Error Image" class="w-100">
                            @else
                            <strong class="text-danger">No Image</strong>
                            @endif
                        </div>
                        @error('thumb') <span class="text-danger">{{$message}}</span>@enderror
                        <input type="file" name="thumb" class="d-none" id="thumb-input" onchange="previewLogo(this, '#thumb-preview', '100%', 'auto')">
                    </div>
                </div>
                <x-input name="name" label="Judul/Nama" :value="$page->name"></x-input>
                <x-input name="url" label="Link" :value="$page->url"></x-input>
            </div>
        </div>
    </div>
    <div class="container p-3">
        <div class="card">
            <div class="card-header bg-dark text-light px-2 py-1">
                <h4>Konten</h4>
            </div>
            <div class="card-body" id="editor">
                {!!$page->content!!}
            </div>
        </div>
    </div>
    <button class="btn btn-dark btn-lg position-fixed m-3" style="bottom:0;right:0;">Simpan</button>
</form>
@endsection

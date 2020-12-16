@extends('layouts.dashboard')
@section('title', 'Menu')

@section('content')
<div class="container pt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Halaman Statis</h4>
            <a href="{{route('static-page.create')}}" class="btn btn-secondary">Tambah Halaman</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-stripped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Thumbnail</th>
                        <th>Nama</th>
                        <th>URL</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statics as $key => $static)
                    <tr>
                        <td>{{$key}}.</td>
                        <td>
                            <div class="rounded bg-secondary d-flex justify-content-center align-items-center" style="width:128px;height;128px;overflow-hidden">
                                @if(Storage::disk('public')->exists($static->thumb))
                                <img src="{{asset($static->thumb)}}" alt="Error Image" class="w-100">
                                @else
                                No Thumb
                                @endif
                            </div>
                        </td>
                        <td>{{$static->name}}</td>
                        <td>{{$static->url}}</td>
                        <td>
                            <div class="dropleft">
                                <button class="btn rounded-pill dropdown-toggle" type="button" id="static-page-action-{{$key}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 0 0-5.86 2.929 2.929 0 0 0 0 5.858z" />
                                    </svg>
                                </button>
                                <div class="dropdown-menu shadow py-0 border-0" aria-labelledby="static-page-action-{{$key}}">
                                    <a class="dropdown-item px-3" href="{{route('static-page.edit', $static->id)}}"><i class="bi bi-pencil-fill"></i> Edit</a>
                                    <button class="dropdown-item px-3" data-toggle="modal" data-target="#confirm-delete-menu" onclick="showConfirmDelete(this, {{json_encode($menu)}})"><i class="bi bi-trash-fill"></i> Hapus</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="confirm-delete-menu">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header py-1 bg-danger text-light pr-1">
                <h4 class="modal-title mb-0">Peringatan</h4>
                <button type="button" class="btn btn-sm shadow btn-dark" data-dismiss="modal" aria-label="Close">
                    <strong aria-hidden="true">&times;</strong>
                </button>
            </div>
            <form action="{{route('static-page.destroy', '')}}" method="post">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus halaman <span class="delete-warning-message"></span> ?</p>
                </div>
                <div class="modal-footer py-1">
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

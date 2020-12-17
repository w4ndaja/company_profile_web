@extends('layouts.dashboard')
@section('title', 'Menu')
@section('content')
<div class="container py-3">
    <div class="row d-flex flex-row-reverse">

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between bg-secondary text-light py-2">
                    <h3 class="mb-0">{{$parent ? "Sub Menu $parent->name" : "Menu Utama"}}</h3>
                    @if($parent) <a href="{{$parent->hasParent() ? route('menu.show', $parent->parent) : route('menu.index')}}" class="btn btn-dark">Kembali</a> @endif
                </div>
                <div class="card-body table-responsive">
                    @if($primaries->count() > 0)
                    <table class="table table-sm table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Icon</th>
                                <th>URL</th>
                                {{-- <th>Sub Menu</th> --}}
                                <th width="50">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($primaries as $key => $menu)
                            <tr>
                                <td>{{$menu->order}}</td>
                                <td>{{$menu->name}}</td>
                                <td>{{$menu->icon}}</td>
                                <td>{{$menu->url}}</td>
                                {{-- <td>
                                    ...Sub Menu List...
                                </td> --}}
                                <td>
                                    <div class="dropleft">
                                        <button class="btn rounded-pill dropdown-toggle" type="button" id="menu-action-{{$key}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 0 0-5.86 2.929 2.929 0 0 0 0 5.858z" />
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu shadow py-0 border-0" aria-labelledby="menu-action-{{$key}}">
                                            <a class="dropdown-item px-3" href="{{route('menu.show', $menu->id)}}"><i class="bi bi-bookmark-plus-fill"></i> Sub Menu</a>
                                            <a class="dropdown-item px-3" href="{{route('menu.edit', $menu->id)}}"><i class="bi bi-pencil-fill"></i> Edit</a>
                                            <button class="dropdown-item px-3" data-toggle="modal" data-target="#confirm-delete-menu" onclick="showConfirmDelete(this, {{json_encode($menu)}})"><i class="bi bi-trash-fill"></i> Hapus</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal" tabindex="-1" role="dialog" id="confirm-delete-menu">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header py-1 bg-danger text-light pr-1">
                                    <h4 class="modal-title mb-0">Peringatan</h4>
                                    <button type="button" class="btn btn-sm shadow btn-dark" data-dismiss="modal" aria-label="Close">
                                        <strong aria-hidden="true">&times;</strong>
                                    </button>
                                </div>
                                <form action="{{route('menu.destroy', '')}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-body">
                                        <p>Apakah anda yakin ingin menghapus menu <span class="delete-warning-message"></span> ?</p>
                                    </div>
                                    <div class="modal-footer py-1">
                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-warning h4">{{$parent ? 'Sub Menu' : 'Menu'}} Kosong</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between bg-secondary text-light py-2">
                    <h3 class="m-0">@if(!$current && !$parent) Tambah Menu Utama @elseif($current) Edit Menu {{$current->name}} @else Tambah Sub Menu {{$parent->name}} @endif</h3>
                    @if($current) <a href="{{ $current->hasParent() ? route('menu.show', $current->parent) : route('menu.index')}}" class="btn btn-dark">Buat Baru</a> @endif
                </div>
                <form action="{{$current ? route('menu.update', $current->id) : route('menu.store', ['menu' => $parent ? $parent->id : null])}}" method="post">
                    @csrf
                    @method($current ? 'patch' : 'post')
                    <div class="card-body">
                        <x-input type="number" step="1" name="order" :value="$current->order ?? ''" label="No"></x-input>
                        <x-input name="name" :value="$current->name ?? ''" label="Nama"></x-input>
                        <x-input name="icon" :value="$current->icon ?? ''" label="Icon Class"></x-input>
                        <x-input name="url" :value="$current->url ?? ''" label="URL"></x-input>
                    </div>
                    <div class="card-footer bg-secondary d-flex justify-content-end py-2"><button class="btn btn-dark" type="submit">@if($current) Simpan Perubahan @else Tambah @endif</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

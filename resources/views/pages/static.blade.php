@extends('layouts.site')
@section('title', $page->name. ' - '.config('theme.name'))
@section('content')
<body class="bg-light mt-5 pt-5">
    <div class="container bg-white p-3 rounded-lg text-dark shadow-sm">
        <h1 class="mt-3 shadow-sm rounded-lg px-3 py-2">{{$page->name}}</h1>
        @if(Storage::disk('public')->exists($page->thumb))
        <img src="{{asset($page->thumb)}}" class="w-100 shadow my-4 rounded">
        @endif
        {!!$page->content!!}
    </div>
</body>
@endsection

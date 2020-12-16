<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Support\Facades\Storage;

class StaticPageController extends Controller
{
    public function index()
    {
        $statics = Pages::paginate();
        return view('pages.dashboard.static-page', compact('statics'));
    }
    public function getView($static)
    {
        dd($static);
    }
    public function create()
    {
        $page = new Pages;
        $title = "Tambah halaman baru";
        $method = "post";
        $action = route('static-page.store');
        $button = "Tambah Baru";
        return view('pages.dashboard.static-page-form', compact('title', 'method', 'action', 'button', 'page'));
    }
    public function store()
    {
        $this->validateForm();
        $page = Pages::create($this->getForm());
        return redirect(route('static-page.index'))->with('success', 'Halaman berhasil ditambah');
    }
    public function update(Pages $page)
    {
        $this->validateForm($page->id);
        $page->update($this->getForm($page));
        return back()->with('success', 'Halaman berhasil diubah');
    }
    public function validateForm($id = null)
    {
        request()->validate([
            'name' => 'required|string',
            'url' => 'required|string|unique:pages,url' . ($id ? ',' . $id : ''),
            'content' => 'sometimes|nullable|string',
            'thumb' => 'sometimes|nullable|image',
        ]);
    }
    public function getForm($data = null)
    {
        $req = request()->only('name', 'url', 'content');
        if ($data && request()->hasFile('thumb') && Storage::disk('public')->exists($data->thumb)) {
            Storage::disk('public')->delete($data->thumb);
        }else if(request()->hasFile('thumb')){
            $req['thumb'] = request()->file('thumb')->store('pages', 'public');
        }
        return $req;
    }
}

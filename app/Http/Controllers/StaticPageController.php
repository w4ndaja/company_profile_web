<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use DOMDocument;
use DOMElement;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class StaticPageController extends Controller
{
    public function index()
    {
        $statics = Pages::paginate();

        return view('pages.dashboard.static-page', compact('statics'));
    }

    public function create()
    {
        $page = new Pages;
        $title = 'Tambah halaman baru';
        $method = 'post';
        $action = route('static-page.store');
        $button = 'Tambah Baru';

        return view('pages.dashboard.static-page-form', compact('title', 'method', 'action', 'button', 'page'));
    }

    public function edit(Pages $page)
    {
        $title = "Edit halaman $page->name";
        $method = 'patch';
        $action = route('static-page.update', $page->id);
        $button = 'Simpan Perubahan';

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
            'url' => 'required|string|unique:pages,url'.($id ? ','.$id : ''),
            'content' => 'sometimes|nullable|string',
            'thumb' => 'sometimes|nullable|mimes:jpg,jpeg,png,gif',
        ]);
    }

    public function getForm($data = null)
    {
        $req = request()->only('name', 'url');
        // echo request()->content;
        // dd('');
        $content = new DOMDocument();
        $content->loadHTML(request()->content);
        $imgs = $content->getElementsByTagName('img');
        if (sizeof($imgs) > 0) {
            foreach ($imgs as $img) {
                $src = $img->getAttribute('src');
                if (strpos($src, 'data:image') > -1 && strpos($src, 'base64') > -1) {
                    $base64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $src));
                    $tempImgPath = sys_get_temp_dir().'/'.\Str::uuid()->toString();
                    file_put_contents($tempImgPath, $base64);
                    $tempImg = new File($tempImgPath);
                    $upFile = new UploadedFile($tempImg->getPathname(), $tempImg->getFilename(), $tempImg->getMimeType(), 0, true);
                    $upFileName = $upFile->store('pages', 'public');
                    $img->setAttribute('src', "/$upFileName");
                }
            }
        }
        $req['content'] = $content->saveHTML();
        if ($data) {
            $oldContent = new DOMDocument();
            $oldContent->loadHTML($data->content);
            foreach ($oldContent->getElementsByTagName('img') as $oldImg) {
                $oldSrc = $oldImg->getAttribute('src');
                if (strpos($req['content'], $oldSrc) > -1) {
                    1;
                } elseif (Storage::disk('public')->exists($oldSrc)) {
                    Storage::disk('public')->delete($oldSrc);
                }
            }
        }
        if ($data && request()->hasFile('thumb') && Storage::disk('public')->exists($data->thumb)) {
            Storage::disk('public')->delete($data->thumb);
        }
        if (request()->hasFile('thumb')) {
            $req['thumb'] = request()->file('thumb')->store('pages', 'public');
        }

        return $req;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
    public $theme;

    public function __construct()
    {
        $this->theme = Theme::firstOrNew();
    }

    public function index()
    {
        return view('pages.dashboard.theme.index', [
            'theme' => $this->theme,
        ]);
    }

    public function update()
    {
        request()->validate([
            'logo' => 'sometimes|mimes:jpeg,png,jpg',
            'name' => 'required|string',
        ]);
        $theme = Theme::updateOrCreate([], $this->getForm());

        return back()->with('success', 'Tema berhasil diperbaharui');
    }

    public function getForm()
    {
        $req = request()->only('name');
        if (request()->hasFile('logo')) {
            Storage::disk('public')->exists($this->theme->logo) ? Storage::disk('public')->delete($this->theme->logo) : 1;
            $req['logo'] = request()->file('logo')->store('theme', 'public');
        }

        return $req;
    }

    public function updateHome()
    {
        Theme::first()->update([
            'home' => request()->content,
        ]);

        return back()->with('success', 'Tampilan beranda berhasil diubah');
    }

    public function updateFooter()
    {
        Theme::first()->update([
            'footer' => request()->footer,
        ]);

        return back()->with('success', 'Tampilan footer berhasil diubah');
    }
}

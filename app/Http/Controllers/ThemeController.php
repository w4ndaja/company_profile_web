<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
    public function index()
    {
        $theme = Theme::firstOrNew();
        return view('pages.dashboard.theme.index', compact('theme'));
    }
    public function update()
    {
        request()->validate([
            'logo' => 'sometimes|mimes:jpeg,png,jpg'
        ]);
        $theme = Theme::first();
        if($theme && $theme->logo){
            Storage::disk('public')->delete($theme->logo);
        }
        Theme::updateOrCreate([],[
            'logo' => request()->file('logo')->store('theme', 'public'),
        ]);
        return back()->with('success', 'Logo berhasil diperbaharui');
    }
}

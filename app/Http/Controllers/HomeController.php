<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pages;
use App\Models\Theme;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    public function __construct()
    {
        $theme = Theme::firstOrNew();
        $menus = Menu::doesntHave('parent')->with('children')->orderBy('order')->get();
        Config::set('theme', $theme);
        Config::set('menus', $menus);
    }

    public function index()
    {
        return view('pages.home');
    }

    public function staticPage(Pages $page)
    {
        return view('pages.static', compact('page'));
    }
}

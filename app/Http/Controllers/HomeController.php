<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Theme;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    function __construct()
    {
        $theme = Theme::firstOrNew();
        $menus = Menu::doesntHave('parent')->with('children')->get();
        Config::set('theme', $theme);
        Config::set('menus', $menus);
    }
    public function index()
    {
        return view('pages.home');
    }
}

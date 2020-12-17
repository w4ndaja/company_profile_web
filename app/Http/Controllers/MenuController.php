<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function primaries()
    {
        return Menu::doesntHave('parent')->paginate(request('perpage') ?? 10);
    }

    public function index()
    {
        $primaries = $this->primaries();
        $current = null;
        $parent = null;

        return view('pages.dashboard.menu.index', compact('primaries', 'current', 'parent'));
    }

    public function store()
    {
        $this->validateForm();
        if ($menu = request('menu')) {
            Menu::findOrFail($menu)->children()->create($this->getForm());
        } else {
            Menu::create($this->getForm());
        }

        return back()->with('success', 'Menu berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        $primaries = $menu->children;
        $parent = $menu;
        $current = null;

        return view('pages.dashboard.menu.index', compact('primaries', 'parent', 'current'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $current = $menu;
        $parent = $menu->parent()->first();
        $primaries = $parent ? $parent->children : $this->primaries();

        return view('pages.dashboard.menu.index', compact('primaries', 'current', 'parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Menu $menu)
    {
        $this->validateForm($menu->id);
        $menu->update($this->getForm());

        return back()->with('success', 'Menu berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return back()->with('success', 'Menu Utama berhasil dihapus');
    }

    public function getForm()
    {
        return collect(request()->only('order', 'name', 'icon', 'url'))->mapWithKeys(function ($menu, $key) {
            return [$key => $menu];
        })->all();
    }

    public function validateForm($id = null)
    {
        request()->validate([
            'name' => [
                'required', function ($attr, $val, $fail) use ($id) {
                    $same = Menu::doesntHave('parent')->where('name', $val);
                    $same = $id ? $same->where('id', '<>', $id) : $same;
                    $same = $same->first();
                    if ($same) {
                        $fail("Menu Utama dengan nama $val sudah ada");
                    }
                },
            ],
            'order' => 'sometimes|nullable|numeric',
            'icon' => 'sometimes|nullable|string',
            'url' => 'sometimes|nullable|string',
        ]);
    }
}

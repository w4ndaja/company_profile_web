<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::view('login', 'pages.login')->middleware(['guest', 'dashboard']);
Route::view('superadmin-created', 'pages.superadmin-created')->middleware('dashboard:didnhaveuser');
Route::post('login', [LoginController::class, 'authenticate'])->name('login')->middleware('guest');
Route::middleware(['dashboard', 'auth'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->group(function () {
        Route::get('', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('menu', MenuController::class)->except('create');
        Route::resource('sub-menu', SubMenuController::class)->except('create');
        Route::resources([
            'static-page' =>  StaticPageController::class,
            'post' =>  PostController::class,
            'category' =>  CategoryController::class,
            'tag' =>  TagController::class,
            'user' =>  UserController::class,
            'role' =>  RoleController::class,
            'permission' =>  PermissionController::class,
        ]);
        Route::get('theme', [ThemeController::class, 'index'])->name('theme.index');
        Route::patch('theme', [ThemeController::class, 'update'])->name('theme.update');
        Route::patch('home-theme', [ThemeController::class, 'updateHome'])->name('home-theme.update');
        Route::patch('footer-theme', [ThemeController::class, 'updateFooter'])->name('footer-theme.update');
        Route::post('assign-role/{user}', [UserController::class, 'assignRole'])->name('user.assign-role');
        Route::post('assign-permission/{user}', [UserController::class, 'assignPermission'])->name('user.assign-permission');
        Route::get('change-password', [UserController::class, 'changePassword'])->name('change-password');
        Route::patch('change-password', [UserController::class, 'attemptChangePassword'])->name('attempt-change-password');

        Route::get('static-page', [StaticPageController::class, 'index'])->name('static-page.index');
        Route::get('static-page/{page}', [StaticPageController::class, 'edit'])->name('static-page.edit');
        Route::post('static-page', [StaticPageController::class, 'store'])->name('static-page.store');
        Route::patch('static-page/{page}', [StaticPageController::class, 'update'])->name('static-page.update');

    });
});

Route::get('{static}', [StaticPageController::class, 'getView']);

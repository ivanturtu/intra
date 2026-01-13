<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Projects\Index as ProjectsIndex;
use App\Livewire\Admin\Projects\Form as ProjectsForm;

Route::get('/', function () {
    $heroProjects = \App\Models\Project::where('in_hero', true)
        ->where('is_published', true)
        ->orderBy('order')
        ->get();
    
    return view('home', ['heroProjects' => $heroProjects]);
});

Route::get('/work', function () {
    return view('work');
});

// Authentication Routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Projects
    Route::get('/projects', function () {
        return view('admin.projects.index');
    })->name('projects.index');
    Route::get('/projects/create', function () {
        return view('admin.projects.form');
    })->name('projects.create');
    Route::get('/projects/{id}/edit', function ($id) {
        return view('admin.projects.form', ['id' => $id]);
    })->name('projects.edit');

    // Categories
    Route::get('/categories', function () {
        return view('admin.categories.index');
    })->name('categories.index');
    Route::get('/categories/create', function () {
        return view('admin.categories.form');
    })->name('categories.create');
    Route::get('/categories/{id}/edit', function ($id) {
        return view('admin.categories.form', ['id' => $id]);
    })->name('categories.edit');

    // INTRAstudio Team Leads
    Route::get('/intra-studio-team-leads', function () {
        return view('admin.intra-studio-team-leads.index');
    })->name('intra-studio-team-leads.index');
    Route::get('/intra-studio-team-leads/create', function () {
        return view('admin.intra-studio-team-leads.form');
    })->name('intra-studio-team-leads.create');
    Route::get('/intra-studio-team-leads/{id}/edit', function ($id) {
        return view('admin.intra-studio-team-leads.form', ['id' => $id]);
    })->name('intra-studio-team-leads.edit');
});

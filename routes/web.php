<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Projects\Index as ProjectsIndex;
use App\Livewire\Admin\Projects\Form as ProjectsForm;

Route::get('/', function () {
    return view('home');
});

Route::get('/work', function () {
    return view('work');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
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
});

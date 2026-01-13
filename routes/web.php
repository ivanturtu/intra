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
    Route::get('/projects', function () {
        return view('admin.projects.index');
    })->name('projects.index');
    Route::get('/projects/create', function () {
        return view('admin.projects.form');
    })->name('projects.create');
    Route::get('/projects/{id}/edit', function ($id) {
        return view('admin.projects.form', ['id' => $id]);
    })->name('projects.edit');
});

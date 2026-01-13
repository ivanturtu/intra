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
    Route::get('/projects', ProjectsIndex::class)->name('projects.index');
    Route::get('/projects/create', ProjectsForm::class)->name('projects.create');
    Route::get('/projects/{id}/edit', ProjectsForm::class)->name('projects.edit');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Projects\Index as ProjectsIndex;
use App\Livewire\Admin\Projects\Form as ProjectsForm;

Route::get('/', function () {
    $heroProjects = \App\Models\Project::where('in_hero', true)
        ->where('is_published', true)
        ->orderBy('order')
        ->get();
    
    // Get 3 projects for slider (excluding hero projects)
    $heroProjectIds = $heroProjects->pluck('id')->toArray();
    $sliderProjects = \App\Models\Project::where('is_published', true)
        ->whereNotIn('id', $heroProjectIds)
        ->with('category')
        ->orderBy('order')
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
    
    // Generate slugs for projects that don't have one
    foreach ($heroProjects as $project) {
        if (empty($project->slug)) {
            $project->slug = \Illuminate\Support\Str::slug($project->title);
            $project->save();
        }
    }
    foreach ($sliderProjects as $project) {
        if (empty($project->slug)) {
            $project->slug = \Illuminate\Support\Str::slug($project->title);
            $project->save();
        }
    }
    
    $categories = \App\Models\Category::orderBy('order')->get();
    
    // Get latest 2 magazine articles (published)
    $magazineArticles = \App\Models\MagazineArticle::where('is_published', true)
        ->with('category')
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->take(2)
        ->get();
    
    return view('home', [
        'heroProjects' => $heroProjects,
        'sliderProjects' => $sliderProjects,
        'categories' => $categories,
        'magazineArticles' => $magazineArticles
    ]);
});

Route::get('/work', function () {
    $categories = \App\Models\Category::orderBy('order')->get();
    $projects = \App\Models\Project::where('is_published', true)
        ->with('category')
        ->orderBy('order')
        ->orderBy('created_at', 'desc')
        ->get();
    
    // Generate slugs for projects that don't have one
    foreach ($projects as $project) {
        if (empty($project->slug)) {
            $project->slug = \Illuminate\Support\Str::slug($project->title);
            $project->save();
        }
    }
    
    return view('works', ['projects' => $projects, 'categories' => $categories]);
})->name('works.index');

Route::get('/work/{project:slug}', function (\App\Models\Project $project) {
    // Only show published projects
    if (!$project->is_published) {
        abort(404);
    }
    // Load relationships
    $project->load(['category', 'projectTeamMembers', 'intraStudioTeamLeads']);
    $categories = \App\Models\Category::orderBy('order')->get();
    return view('work', ['project' => $project, 'categories' => $categories]);
})->name('work.show');

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

    // Magazine
    Route::get('/magazine', function () {
        return view('admin.magazine.index');
    })->name('magazine.index');
    Route::get('/magazine/create', function () {
        return view('admin.magazine.form');
    })->name('magazine.create');
    Route::get('/magazine/{id}/edit', function ($id) {
        return view('admin.magazine.form', ['id' => $id]);
    })->name('magazine.edit');

    // Magazine Categories
    Route::get('/magazine-categories', function () {
        return view('admin.magazine-categories.index');
    })->name('magazine-categories.index');
    Route::get('/magazine-categories/create', function () {
        return view('admin.magazine-categories.form');
    })->name('magazine-categories.create');
    Route::get('/magazine-categories/{id}/edit', function ($id) {
        return view('admin.magazine-categories.form', ['id' => $id]);
    })->name('magazine-categories.edit');

    // Settings
    Route::get('/settings', function () {
        return view('admin.settings.form');
    })->name('settings.index');

    // Users
    Route::get('/users', function () {
        return view('admin.users.index');
    })->name('users.index');
    Route::get('/users/create', function () {
        return view('admin.users.form');
    })->name('users.create');
    Route::get('/users/{id}/edit', function ($id) {
        return view('admin.users.form', ['id' => $id]);
    })->name('users.edit');
});

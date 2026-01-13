@extends('layouts.admin')

@section('content')
    @livewire('admin.projects.form', ['id' => $id ?? null])
@endsection

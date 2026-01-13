@extends('layouts.admin')

@section('content')
    @livewire('admin.magazine-categories.form', ['id' => $id ?? null])
@endsection

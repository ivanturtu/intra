@extends('layouts.admin')

@section('content')
    @livewire('admin.categories.form', ['id' => $id ?? null])
@endsection

@extends('layouts.admin')

@section('content')
    @livewire('admin.magazine.form', ['id' => $id ?? null])
@endsection

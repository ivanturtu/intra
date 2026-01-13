@extends('layouts.admin')

@section('content')
    @livewire('admin.users.form', ['id' => $id ?? null])
@endsection

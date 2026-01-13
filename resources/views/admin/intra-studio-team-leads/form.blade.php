@extends('layouts.admin')

@section('content')
    @livewire('admin.intra-studio-team-leads.form', ['id' => $id ?? null])
@endsection

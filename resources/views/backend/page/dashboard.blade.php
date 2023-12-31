@extends('layouts.modernize')

@section('title', 'Dashboard')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Dashboard Page</h5>
      <p class="mb-0">This is a dashboard page </p>
    </div>
</div>
@endsection

@section('css')
@endsection


@section('js')
@endsection

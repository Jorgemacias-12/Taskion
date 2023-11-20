@extends('base')

@section('title', 'User info')

@push('styles')
  <link rel="stylesheet" href="/public/css/app.css">
  <link rel="stylesheet" href="/public/css/navigation.css">
  <link rel="stylesheet" href="/public/css/projects.css">
  <link rel="stylesheet" href="/public/css/user.css">
@endpush

@push('scripts')
  <script defer src="/public/js/app.js"></script>
@endpush

@php
  $user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;
@endphp

@section('navigation')
  @include('components.navigation')
@endsection

@section('content')

  <form action="/app/user/edit" method="POST" class="form" 
  enctype="multipart/form-data">

    <section class="form-group">
      <input class='input' type="text" name="name" id="name" value="{{ $user->getName() }}">
      @if (isset($errors) && $errors->has('name'))
        <p class="error">
          <span class="close fas fa-times"></span>
          {{ $errors->first('name') }}
        </p>
      @endif
    </section>

  </form>
@endsection
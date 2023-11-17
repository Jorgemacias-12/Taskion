@extends('base')

@section('title', 'Page Not Found')

@push('styles')
  <link rel="stylesheet" href="/public/css/404.css">
@endpush

@section('content')
  <h1 class="title">
      404 - Page not found
  </h1>
  <p class="trace">
      Requested URL by user was: /{{ $url }}
      but is not available on this server
  </p>

  <img class="cat" src="https://cataas.com/cat" alt="random cat image">
@endsection

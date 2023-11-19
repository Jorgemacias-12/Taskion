@extends('base')

@section('title', 'Page Not Found')

@push('styles')
  <link rel="stylesheet" href="/public/css/initial.css">
  <link rel="stylesheet" href="/public/css/header.css">
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

  <img class="cat" src="https://t3.ftcdn.net/jpg/02/61/08/76/360_F_261087622_8eRI0TAwDAyabS1b0Uifx1wKqHzA41r3.jpg" alt="random cat image">
@endsection

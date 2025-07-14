@extends('layouts.error')

@section('title', 'Page Not Found')

@section('content')
<img src="{{ asset('assets/media/errors/404.svg') }}" alt="Page Not Found Image">
<h4 class="title">Page not found!</h4>
<p class="page-para">Whoops! It seems the page you are looking for does not exist</p>
<a href="{{ url('/') }}" class="btn btn-error">Go to Homepage</a>
@endsection
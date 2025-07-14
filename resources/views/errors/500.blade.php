@extends('layouts.error')

@section('title', 'Server Error!')

@section('content')
<img src="{{ asset('assets/media/errors/500.svg') }}" alt="Server Error! Image">
<h4 class="title">Server Error!</h4>
<p class="page-para">Our server seems to be facing a problem.</p>
<a href="{{ url('/') }}" class="btn btn-error">Go to Homepage</a>
@endsection
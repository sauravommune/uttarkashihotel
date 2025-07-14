@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))





@extends('layouts.error')

@section('title', 'Access Denied!')

@section('content')
<img src="{{ asset('assets/media/errors/403.svg') }}" alt="Access Denied! Image">
<h4 class="title">Access Denied!</h4>
<p class="page-para">Unfortunately you do not have access to this page right now.</p>
<a href="{{ url('/') }}" class="btn btn-error">Go to Homepage</a>
@endsection
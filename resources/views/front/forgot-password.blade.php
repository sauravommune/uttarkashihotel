@php
use Carbon\Carbon;
@endphp
@extends('front.layouts.app')
@section('content')
    <section class="section-28 py-xl-5 py-4">
        <div class="container py-xl-4 py-4">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-12 col-md-6 col-lg-6">
                    <div class="card shadow">
                        <div class="card-body p-4">
                            <h1 class="h4 text-center mb-xl-3 mb-0">Reset Password</h1>
                            <p class="text-center text-muted mb-4">Choose a new password for your account.</p>
                            <form>
                                <!-- Email Input -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" value="test.ommunne@gmail.com" readonly>
                                </div>

                                <!-- Password Input -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter your new password" required>
                                </div>

                                <!-- Confirm Password Input -->
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Re-enter your new password" required>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
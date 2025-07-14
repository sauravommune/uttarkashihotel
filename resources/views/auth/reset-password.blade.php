
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
                                <form action="{{ route('password.store') }}" method="POST">
                                    @csrf
                                    <!-- Email Input -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type ="email" class="form-control form-control-solid" type="email"
                                            name="email" value="{{old('email', $request->email)}}" 
                                            autocomplete="email" disabled>

                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type ="hidden" class="form-control form-control-solid" type="email"
                                            name="email" value="{{old('email', $request->email)}}"
                                            autocomplete="email">
                                    </div>

                                    <!-- Password Input -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" value="{{old('password')}}" id="password" class="form-control form-control-solid"
                                            name="password">

                                            @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
        
                                    </div>
                                   
                                    <!-- Confirm Password Input -->
                                    <div class="mb-3">
                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                        <input type="password" id="password_confirmation" class="form-control form-control-solid"
                                          value="{{ old('password_confirmation') }}" name="password_confirmation"
                                            autocomplete="new-password">
                                            @error('password_confirmation')
                                           <div class="text-danger">{{ $message }}</div>
                                            @enderror
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

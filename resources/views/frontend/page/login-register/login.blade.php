@extends('frontend.layouts.app')
@section('title')
    Create New Customer Account
@endsection
@section('content')
@include('frontend.page.navbar')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center py-5">
            <div class="col-lg-10">
                <h4>Welcome to Daraz! Please login.</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" autocomplete="email"
                                            placeholder="Enter your email or username" autofocus />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="password">Password</label>
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}">
                                                    <small>Forgot Password?</small>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                autocomplete="current-password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" />
                                            <span class="input-group-text cursor-pointer">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">

                                            <input type="checkbox" class="form-check-input" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }} />
                                            <label class="form-check-label" for="remember-me"> Remember Me </label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <h6>Or, sign up with</h6>
                                <div class="d-flex flex-column">
                                    <a href="" class="btn w-100 p-2 text-white mb-3" style="background:#3b5998">
                                        <i class="fab fa-facebook"></i>Facebook</a>

                                    <a href="" class="btn w-100 p-2 text-white" style="background:rgb(211, 72, 54)">
                                        <i class="fa fa-envelope"></i>
                                        Google</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

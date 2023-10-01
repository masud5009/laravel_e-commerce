@extends('frontend.layouts.app')
@section('title')
    Create New Customer Account
@endsection
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center py-5">
            <div class="col-lg-10">
                <h4>Welcome to Daraz! Please login.</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="form-label font-weight-light">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" id="name" name="name" autocomplete="name"
                                            autofocus placeholder="Enter your username" autofocus />
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label font-weight-light">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" autocomplete="email"
                                            placeholder="Enter your email" />

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label font-weight-light" for="password">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                autocomplete="new-password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" />
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label font-weight-light" for="password_confirmation">Confirm
                                            Password</label>
                                        <div class="input-group input-group-merge">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" autocomplete="new-password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" />
                                        </div>
                                    </div>
                                    <button class="btn btn-primary">SIGN UP</button>
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

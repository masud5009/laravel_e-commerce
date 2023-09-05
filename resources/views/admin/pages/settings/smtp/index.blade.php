@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="card mb-4">
                    <h5 class="card-header">SEO Setting Update</h5>
                    <div class="card-body">
                        <form action="{{ route('smtp.update') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="mailer" class="form-label">mailer</label>
                                        <input type="text" class="form-control" id="mailer" name="mailer"
                                            @if ($smtp) value="{{ $smtp->mailer }}" @endif>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="host" class="form-label">host</label>
                                        <input type="text" class="form-control" id="host" name="host"
                                            @if ($smtp) value="{{ $smtp->host }}" @endif>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="port" class="form-label">port</label>
                                        <input type="text" class="form-control" id="port" name="port"
                                            @if ($smtp) value="{{ $smtp->port }}" @endif>
                                        <div class="form-text">
                                            Example: ecommerce, online shop, online market
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_name" class="form-label">user_name</label>
                                        <input type="text" class="form-control" id="user_name"
                                            name="user_name"
                                            @if ($smtp) value="{{ $smtp->user_name }}" @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">password</label>
                                    <input type="text" class="form-control" id="password"
                                        name="password"
                                        @if ($smtp) value="{{ $smtp->password }}" @endif>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-end" id="saveBtn">
                                Submit <i class='bx bxs-right-arrow'></i></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

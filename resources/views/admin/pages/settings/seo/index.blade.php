@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="card mb-4">
                    <h5 class="card-header">SEO Setting Update</h5>
                    <div class="card-body">
                        <form action="{{ route('seo.update')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="seo_title" class="form-label">seo title</label>
                                        <input type="text"
                                               class="form-control"
                                               id="seo_title"
                                               name="seo_title"
                                               @if ($seo)
                                                value="{{ $seo->seo_title}}"
                                               @endif>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_author" class="form-label">meta author</label>
                                        <input type="text" class="form-control" id="meta_author" name="meta_author" @if ($seo)
                                        value="{{ $seo->meta_author}}"
                                       @endif>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="meta_keywords" class="form-label">meta keywords</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" @if ($seo)
                                        value="{{ $seo->meta_keywords}}"
                                       @endif>
                                        <div class="form-text">
                                            Example: ecommerce, online shop, online market
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="google_verification" class="form-label">google verification</label>
                                        <input type="text" class="form-control" id="google_verification"
                                            name="google_verification" @if ($seo)
                                            value="{{ $seo->google_verification}}"
                                           @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="meta_description" class="form-label">meta description</label>
                                        <textarea class="form-control" name="meta_description" id="meta_description" rows="5">@if ($seo){{$seo->meta_description}} @endif</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="google_analytics" class="form-label">google_analytics</label>
                                        <textarea class="form-control" name="google_analytics" id="google_analytics" rows="5">@if ($seo){{ $seo->google_analytics}}@endif</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="canonical_url" class="form-label">canonical url</label>
                                        <input type="url" class="form-control" id="canonical_url" name="canonical_url" @if ($seo)
                                        value="{{ $seo->canonical_url}}"
                                       @endif>
                                        <div class="form-text">
                                            The canonical URL that this page should point to. Leave empty to default to
                                            permalink. Cross domain canonical supported too
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alexa_verification" class="form-label">alexa verification</label>
                                        <input type="text" class="form-control" id="alexa_verification"
                                            name="alexa_verification" @if ($seo)
                                            value="{{ $seo->alexa_verification}}"
                                           @endif>
                                    </div>
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

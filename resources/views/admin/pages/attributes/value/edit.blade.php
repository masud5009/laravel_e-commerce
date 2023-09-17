@extends('admin.layouts.app')
@push('css')
    <!-- Ajax Cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush


@section('content')
    <div class="container">
        <h5 class="text-dark ml-5">Attribute Value Information</h5>
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Update Attribute Value</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('attribute-value.update',['attribute_value'=>$attributeValue->id])}}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" value="{{ $attributeValue->id}}" name="attribute_value_id">
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{ $attributeValue->value }}" name="name" id="name"
                                class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success float-end mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/.Bootsttap modal-->
@endsection
@push('scripts')
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

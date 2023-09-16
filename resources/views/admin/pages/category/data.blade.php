@foreach ($categories as $key => $category)
    <div class="accordion border-bottom" id="categorySelector{{ $category->id }}">
        <div class="accordion-item">
            <h2 class="accordion-header d-flex justify-content-between" id="heading">
                <div class="col-lg-10 d-flex justify-content-around align-items-center">
                    <i class='bx bx-plus-circle text-danger fs-5'></i>
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $category->id }}" aria-expanded="false" aria-controls="collapseTwo">
                        {{ $category->name }}
                    </button>
                </div>
                <div class="col-lg-2 d-flex justify-content-end align-items-center">
                    <a href="javascript:void(0)" class="btn-sm btn btn-primary m-2 editBtn"
                        data-id="{{ $category->id }}">
                        <i class="bx bx-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn-sm btn btn-danger m-2 deletBtn"
                        data-id="{{ $category->id }}">
                        <i class="bx bx-trash"></i>
                    </a>
                </div>
            </h2>
            <div id="collapse{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="heading"
                data-bs-parent="#categorySelector{{ $category->id }}">
                <div class="accordion-body">
                    <div class="d-flex justify-content-between align-items-center py-4 border-bottom">
                        <span>#</span>
                        <h5>{{ $key + 1 }}</h5>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-4 border-bottom">
                        <span>Banner</span>
                        <img src="{{ asset('storage/images/category_img/' . $category->banner) }}" alt=""
                            style="max-width: 100px;max-height:100px">
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-4 border-bottom">
                        <span>Icon</span>
                        <img src="{{ asset('storage/images/category_img/' . $category->icon) }}" alt=""
                            style="max-width: 100px;max-height:100px">
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-4 border-bottom">
                        <span>Cover Image</span>
                        <img src="{{ asset('storage/images/category_img/' . $category->cover_img) }}" alt=""
                            style="max-width: 100px;max-height:100px">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

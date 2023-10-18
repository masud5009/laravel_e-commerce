<div class="container-fluid  mb-5" style="height: 400px; overflow: hidden;">
    <div class="row">
        <div class="col-lg-4 px-5">
            <div class="d-flex">
                <nav style="height: 95%; border-radius: 10px;box-shadow:0px 0px 1px 0px black"
                    class="navbar navbar-vertical navbar-light align-items-start bg-light sidebar">
                    <ul class="navbar-nav w-100">
                        @foreach ($categories as $category)
                            <li class="category-menu nav-item">
                                <a href="#" class="nav-link px-2">
                                    {{ $category->name }}
                                    <i class="fa fa-angle-right float-right mt-1 px-2"></i>
                                </a>
                                <div
                                    class="subcategories navbar navbar-vertical navbar-light  align-items-start bg-light sidebar px-3">
                                    <ul style="list-style: none" class="navbar-nav w-100">
                                        @if ($category->subcategory->count() > 0)
                                            @foreach ($category->subcategory as $subcategory)
                                                <li class="nav-item childcategory">
                                                    <a href="#" class="nav-link px-2">
                                                        {{ $subcategory->name }}
                                                        <i class="fa fa-angle-right float-right mt-1 px-2"></i>
                                                    </a>
                                                    <div
                                                        class="childcategories navbar navbar-vertical navbar-light  align-items-start bg-light sidebar px-3">
                                                        <ul style="list-style: none" class="navbar-nav w-100">
                                                            @if ($subcategory->childcategory->count() > 0)
                                                                @foreach ($subcategory->childcategory as $childcategory)
                                                                    <li class="nav-item">
                                                                        <a href="#" class="nav-link px-2">
                                                                            {{ $childcategory->name }}
                                                                            <i
                                                                                class="fa fa-angle-right float-right mt-1 px-2"></i>
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </nav>

                <!-- hover effect -->
                {{-- <nav class="subcategories navbar navbar-vertical navbar-light  align-items-start bg-light sidebar">
                    <div class="navbar-nav w-100 overflow-hidden">
                        @foreach ($categories as $category)
                            <a href="#" class="nav-link px-2">
                                {{ $category->name }}
                                <i class="fa fa-angle-right float-right mt-1 px-2"></i>
                            </a>
                        @endforeach
                    </div>
                </nav> --}}
                {{-- <div class="bg-light subcategories">
                    @foreach ($categories as $category)
                            <a href="#" class="nav-link px-2">
                                {{ $category->name }}
                                <i class="fa fa-angle-right float-right mt-1 px-2"></i>
                            </a>
                        @endforeach
                </div> --}}
            </div>

        </div>


        <div class="col-lg-8">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <!-- Add more indicators as needed -->
                </ol>

                <!-- Slides -->
                <div class="carousel-inner">
                    @foreach ($categories as $key => $category)
                        <div class="carousel-item {{ $key === 1 ? 'active' : '' }}">
                            <a href="{{ route('category.product', $category->slug) }}">
                                <img src="{{ $category->banner }}" alt="{{ $category->name }}"
                                    style="width: 100%;background-size:cover;height:100%">
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Buttons -->
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    </div>
</div>

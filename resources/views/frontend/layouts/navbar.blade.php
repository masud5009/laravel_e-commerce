    <!-- navbar -->
    <div id="navbar" class="bg-warning">
        <div class="container-fluid mb-5">
            <div class="row border-top px-xl-5">
                <div class="col-lg-3 d-none d-lg-block">
                    <a class="btn shadow-none d-flex align-items-center justify-content-between  text-white w-100"
                        data-toggle="collapse" href="#navbar-vertical"
                        style="height: 65px; margin-top: -1px; padding: 0 30px;">
                        <h6 class="m-0">Categories</h6>
                        <i class="fa fa-angle-down text-dark"></i>
                    </a>
                    <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
                        id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                        <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                            @foreach ($categories as $category)
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link" data-toggle="dropdown">{{ $category->name }} <i
                                            class="fa fa-angle-down float-right mt-1"></i></a>
                                    {{-- @if ($category->subcategory->count() > 0)
                                        @foreach ($category->subcategory as $subcategory)
                                            <div
                                                class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                                <a href="" class="dropdown-item">{{ $subcategory->name }}</a>
                                            </div>
                                        @endforeach
                                    @endif --}}

                                </div>
                            @endforeach
                        </div>
                    </nav>
                </div>
                <div class="col-lg-9">
                    <nav class="navbar navbar-expand-lg bg-warning navbar-light py-3 py-lg-0 px-0">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between bg-warning" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="{{ route('website.home') }}" class="nav-item nav-link">Home</a>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                    <div class="dropdown-menu rounded-0 m-0">
                                        <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                        <a href="checkout.html" class="dropdown-item">Checkout</a>
                                    </div>
                                </div>
                                <a href="contact.html" class="nav-item nav-link">Contact</a>
                            </div>
                            <div class="navbar-nav ml-auto py-0">
                                @if (auth()->user())
                                    <a href="" class="nav-item nav-link">Profile</a>
                                    <a class="d-flex justify-center align-items-center" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span class="align-middle">Log Out</span>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                        </form>
                                    </a>
                                @else
                                    <a href="{{ route('customer.account.login') }}" class="nav-item nav-link">Login</a>
                                    <a href="{{ route('customer.account.create') }}"
                                        class="nav-item nav-link">Register</a>
                                @endif
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /.navbar -->

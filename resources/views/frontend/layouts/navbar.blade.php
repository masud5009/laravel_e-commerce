<div class="bg-warning col-lg-9" style="height: 100%">
    <nav class="navbar navbar-expand-lg bg-warning navbar-light py-lg-0 px-0">
        <a href="{{ route('website.home') }}" class="text-decoration-none d-block d-lg-none">
            <h1 class="m-0 display-5 font-weight-semi-bold"><span
                    class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
                <a href="{{ route('website.home') }}" class="nav-item nav-link active">Home</a>
                <a href="{{ route('product.shop') }}" class="nav-item nav-link">Shop</a>
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
                <a href="" class="nav-item nav-link">Login</a>
                <a href="{{ route('customer.account.create') }}" class="nav-item nav-link">Register</a>
            </div>
        </div>
    </nav>
</div>

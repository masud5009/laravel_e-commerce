@foreach ($products as $product)
    @if ($product->count() > 0)
        @php

            $unit_price = $product->unit_price;
            $discount_value = $product->discount_price;
            $discountPrecente = $unit_price * ($discount_value / 100);
            $price_real = $unit_price - $discountPrecente;
            $price = number_format(round($price_real, 0, PHP_ROUND_HALF_DOWN), 2);
        @endphp
        <a href="{{ route('product.details', $product->slug) }}" class="text-dark d-flex">
            <div> <img src="{{ asset($product->thumbnail) }}" alt="" style="width: 50px"></div>

            <div class="px-2">
                <span>{{ $product->name }}</span>
                <h5 class="text-danger">{{ $price }}</h5>
            </div>
        </a>
        <hr>
    @else
        <li>Product Not Found</li>
    @endif
@endforeach

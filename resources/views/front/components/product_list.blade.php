@if ($paginator->isNotEmpty())
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($paginator as $product)
            <div class="col">
                <div class="card">
                    <img src="https://via.placeholder.com/200x200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('products.show', $product) }}">{{ $product->title }}</a></h5>
                        <p class="card-text">
                            {{ $product->price }} Р
                        </p>
                        <div class="justify-content-start d-flex">
                            <form action="{{ route('baskets.add', ['id' => $product->id]) }}" method="post" class="me-1">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm" title="В корзину"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                            </form>
                            <button class="btn btn-danger btn-sm" title="В избранное"><i class="fa fa-heart-o" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

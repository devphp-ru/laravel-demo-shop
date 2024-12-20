@extends('front.layouts.default')

@section('meta_title', $title)

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('front.components.category_list')
            @include('front.components.brands_list')
        </div>
        <div class="col-md-8">

            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://imgholder.ru/500x500/8493a8/adb9ca&text=IMAGE+HOLDER&font=kelson" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text">{{ $product->content }}</p>
                            <h5 class="card-title">{{ $product->price }} Р</h5>
                            @if (session()->has('error'))
                                <span class="text-danger">{{ session('error') }}</span>
                            @endif
                            @if ($product->quantity > 0)
                            <form action="{{ route('baskets.add', ['id' => $product->id]) }}" method="post">
                                @csrf
                                <label for="input_quantity">Количество</label>
                                <input type="text" name="quantity" id="input_quantity" value="1">
                                <button type="submit" class="btn btn-success btn-sm">Добавить в корзину</button>
                            </form>
                            @else
                                <span class="text-danger">Товара нет в наличии</span>
                            @endif
                            <p class="card-text"><small class="text-muted">Количество: <span>{{ $product->quantity }}</span></small></p>
                            <button class="btn btn-primary btn-sm" title="В корзину"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                            <button class="btn btn-danger btn-sm" title="В избранное"><i class="fa fa-heart-o" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

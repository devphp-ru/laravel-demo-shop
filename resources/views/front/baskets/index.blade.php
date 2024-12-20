@extends('front.layouts.default')

@section('meta_title', $title)

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('front.components.category_list')
            @include('front.components.brands_list')
        </div>
        <div class="col-md-8">

            <h1>{{ $title }}</h1>

            @if (is_null($basket) || $basket->products->isEmpty())
                <h3>Товаров нет</h3>
            @else
                <form action="{{ route('baskets.clear') }}" method="post" class="text-end">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm mb-2 mt-2">Очистить корзину</button>
                </form>

                <table class="table table-bordered">
                    <tr>
                        <th>№</th>
                        <th>Наименование</th>
                        <th>Цена</th>
                        <th>Кол-во</th>
                        <th>Стоимость</th>
                        <th></th>
                    </tr>
                    @foreach($basket->products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('products.show', $product) }}">{{ $product->title }}</a>
                            </td>
                            <td>{{ number_format($product->price, 2, '.', '') }}</td>
                            <td>
                                <form action="{{ route('baskets.minus', ['id' => $product->id]) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                    </button>
                                </form>
                                <span class="mx-1">{{ $product->pivot->quantity }}</span>
                                @if ($product->quantity)
                                    <form action="{{ route('baskets.plus', ['id' => $product->id]) }}" method="post" class="d-inline">
                                        @csrf
                                        <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                @else
                                    <i class="fa fa-plus text-danger" aria-hidden="true" title="Максимальное количество товара"></i>
                                @endif
                            </td>
                            <td>{{ number_format($product->price * $product->pivot->quantity , 2, '.', '') }}</td>
                            <td>
                                <form action="{{ route('baskets.remove', $product) }}" method="post" class="text-center">
                                    @csrf
                                    <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="4" class="text-right">Итого</th>
                        <th>{{ number_format($basket->getTotalAmount(), 2, '.', '') }}</th>
                    </tr>
                </table>
            @endif
        </div>
    </div>
@endsection

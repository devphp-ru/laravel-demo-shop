@extends('shops.layouts.default')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('shops.components.category_list')
            @include('shops.components.brands_list')

        </div>
        <div class="col-md-8">
            <h2>{{ __('Все бренды') }}</h2>
            @if ($paginator->isNotEmpty())
                <nav class="row">
                    @foreach ($paginator as $value)
                        <div class="col-md-4 mb-2">
                            <div class="card">
                                <img src="{{ $value->thumbnail }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __($value->title) }}</h5>
                                    <p class="card-text">{{ $value->category->name }}</p>
                                    <p class="card-text">{{ $value->brand->name }}</p>
                                    <p class="card-text">{{ $value->price }} руб.</p>
                                    <a href="#" class="btn btn-primary">В корзину</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            {{ $paginator->links('vendor.pagination.bootstrap-4') }}
                        </ul>
                    </nav>
            @endif
        </div>
    </div>
@endsection
@push('category_js')
<script src="{{ asset('/assets/js/script.js') }}"></script>
@endpush

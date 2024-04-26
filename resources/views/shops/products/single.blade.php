@extends('shops.layouts.default')

@section('title', $item->title)

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('shops.components.category_list')
            @include('shops.components.brands_list')

        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ $item->thumbnail }}" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><h2>{{ $item->title }}</h2></h5>
                            <p class="card-text">{{ $item->price }} руб.</p>
                            <p class="card-text"><small class="text-muted">Что то важное тут будет</small></p>
                            <a href="#" class="btn btn-primary btn-sm">{{ __('В корзину') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Описание') }}</div>
                <div class="card-body">
                    <p class="card-text">{{ $item->content }}</p>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('category_js')
<script src="{{ asset('/assets/js/script.js') }}"></script>
@endpush

@extends('shops.layouts.default')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('shops.components.category_list')

        </div>
        <div class="col-md-8">
            <h2>{{ $title }}</h2>
        </div>
    </div>
@endsection
@push('category_js')
<script src="{{ asset('/assets/js/script.js') }}"></script>
@endpush

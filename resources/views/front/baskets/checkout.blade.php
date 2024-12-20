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

        </div>
    </div>
@endsection

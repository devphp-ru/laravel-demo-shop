@extends('front.layouts.default')

@section('meta_title', $title)

@section('content')
<div class="row">
    <div class="col-md-4">
        @include('front.components.category_list')
        @include('front.components.brands_list')
    </div>
    <div class="col-md-8">
       <div class="row">
           @foreach ($brands as $brand)
               <div class="col-md-6 mb-3">
                   <div class="card">
                       <div class="card-header"><a href="{{ route('brands.show', $brand) }}">{{ $brand->name }}</a></div>
                   </div>
               </div>
           @endforeach
       </div>
    </div>
</div>
@endsection

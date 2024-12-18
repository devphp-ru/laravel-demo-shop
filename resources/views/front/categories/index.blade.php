@extends('front.layouts.default')

@section('meta_title', $title)

@section('content')
<div class="row">
    <div class="col-md-4">
        @include('front.components.category_list')
    </div>
    <div class="col-md-8">
       <div class="row">
           @foreach ($categories as $category)
               <div class="col-md-6 mb-3">
                   <div class="card">
                       <div class="card-header">{{ $category->name }}</div>
                       @if ($category->children->count())
                        <ul class="list-group list-group-flush">
                            @foreach ($category->children as $children)
                                <li class="list-group-item"><a href="{{ route('categories.show', $children) }}">{{ $children->name }}</a></li>
                            @endforeach
                        </ul>
                       @endif
                   </div>
               </div>
           @endforeach
       </div>
    </div>
</div>
@endsection

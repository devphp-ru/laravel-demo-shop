@extends('shops.layouts.default')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h3>{{ __('Каталог') }}</h3>
            <div id="catalog-sidebar">
                <ul class="list-group list-group-flush">
                    @foreach ($categories as $category)
                        <li class="list-group-item">
                            <a href="{{ route('shop.categories.single', $category) }}">{{ $category->name }}</a>
                            @if ($category->children->count())
                                <span class="badge text-bg-light" style="cursor:pointer"><i class="fa fa-plus" aria-hidden="true"></i> </span>
                                <ul class="list-group list-group-flush">
                                    @foreach ($category->children as $children)
                                        <li class="list-group-item">
                                            <a href="{{ route('shop.categories.single', $children) }}">{{ $children->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
        <div class="col-md-8">
            <h2>{{ $title }}</h2>
        </div>
    </div>
@endsection
@push('category_js')
    <script>
        $(() => {
            $('#catalog-sidebar > ul ul').hide();
            $('#catalog-sidebar .badge').on('click', function () {
                let $badge = $(this);
                let closed = $badge.siblings('ul') && !$badge.siblings('ul').is(':visible');

                if (closed) {
                    $badge.siblings('ul').slideDown('normal', function () {
                        $badge.children('i').removeClass('fa-plus').addClass('fa-minus');
                    });
                } else {
                    $badge.siblings('ul').slideUp('normal', function () {
                        $badge.children('i').removeClass('fa-minus').addClass('fa-plus');
                    });
                }
            });
        });
    </script>
@endpush

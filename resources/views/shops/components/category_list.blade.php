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

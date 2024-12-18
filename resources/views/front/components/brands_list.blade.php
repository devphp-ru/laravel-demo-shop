<h3>{{ __('Бренды') }}</h3>
<div id="catalog-sidebar">
    <ul class="list-group list-group-flush">
        @foreach ($brandsList as $brand)
            <li class="list-group-item">
                <a href="{{ route('brands.show', $brand) }}">{{ $brand->name }}</a>
            </li>
        @endforeach
    </ul>
</div>

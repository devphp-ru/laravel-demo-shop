<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('shop.index') }}">{{ __(env('APP_NAME')) }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('shop.index') }}">{{ __('Главная') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('categories.index') }}">{{ __('Каталог') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('brands.index') }}">{{ __('Бренды') }}</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Поиск" aria-label="Поиск">
                <button class="btn btn-outline-success" type="submit">Поиск</button>
            </form>
        </div>
    </div>
</nav>

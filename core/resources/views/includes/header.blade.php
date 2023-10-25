<header>
    <div class="header__wrapper">
        <a href="/" class="header__logo">
            {{ env('APP_NAME') }}
        </a>

        <nav class="header__nav">
            <a href="/dashboard" class="header__nav-link">
                Рабочий стол
            </a>

            <a href="/swagger.yaml" class="header__nav-link">
                Документация
            </a>

            <a href="/admin/login" class="header__nav-link">
                Админ-панель
            </a>
            @if (\Illuminate\Support\Facades\Auth::check())
            <a href="/auth/logout" class="header__nav-link">
                Выйти
            </a>
            @endif
        </nav>
    </div>
</header>

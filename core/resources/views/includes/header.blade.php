<header>
    <div class="header__wrapper">
        <a href="/" class="header__logo">
            {{ env('APP_NAME') }}
        </a>

        <nav class="header__nav">
            <a href="/dashboard" class="header__nav-link">
                Рабочий стол
            </a>
            @if(!empty($project))
            <a href="/project/{{ $project->id }}/reports" class="header__nav-link">
                Отчеты
            </a>
            @endif
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

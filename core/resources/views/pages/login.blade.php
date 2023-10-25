@extends('layouts.main')

@php
    $page_title = "Авторизация"
@endphp

@section('content')
    <main>
        <h1 class="heading-1">Авторизация</h1>

        <form class="auth-form" method="post" action="/api/auth/login">
            @csrf
            @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
            @endif
            <label>
                <span>E-mail</span>
                <input type="email" class="auth-form__input" name="email" placeholder="email@example.com" required>
            </label>

            <label>
                <span>Пароль</span>
                <input type="password" class="auth-form__input" name="password" required>
            </label>

            <button class="primary-button">Войти</button>

            <a href="/signup" class="link align-center">Нет аккаунта? Зарегистрироваться</a>
        </form>
    </main>
@endsection

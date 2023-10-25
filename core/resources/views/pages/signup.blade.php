@extends('layouts.main')

@php
    $page_title = "Регистрация в системе"
@endphp

@section('content')
    <main>
        <h1 class="heading-1">Регистрация в системе</h1>

        <form class="auth-form" method="post" action="/auth/signup">
            @csrf
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <label>
                <span>Имя</span>
                <input type="text" class="auth-form__input" name="name" placeholder="Например, Владислав" required>
            </label>

            <label>
                <span>E-mail</span>
                <input type="email" class="auth-form__input" name="email" placeholder="email@example.com" required>
            </label>

            <label>
                <span>Пароль</span>
                <input type="password" class="auth-form__input" name="password" required>
            </label>

            <button class="primary-button">Зарегистрироваться</button>

            <a href="/login" class="link align-center">Уже зарегистрированы? Войти</a>
        </form>
    </main>
@endsection

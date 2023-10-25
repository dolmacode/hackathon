@extends('layouts.main')

@php
    $page_title = "Профиль проекта"
@endphp

@section('content')
    <style>
        body, html {
            overflow-y: scroll;
        }
    </style>
    <main class="project-profile">
        <form class="auth-form" method="post" action="/project/save">
            @csrf
            <label>Название проекта</label>
            <input class="auth-form__input" name="name" required>
            <textarea name="description" class="auth-form__input textarea"></textarea>
            <button class="primary-button">Сохранить</button>
        </form>

            <div class="project__members">
                <h3 class="heading-3 align-center">Участники проекта</h3>
                <table class="table">
                    <tr>
                        <th>Имя</th>
                        <th>Роль</th>
                        <th>Удалить</th>
                    </tr>
                    <tr>
                        <td>Владислав</td>
                        <td>
                            <select name="" class="auth-form__input">
                                <option value="member">Участник</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </td>
                        <td>
                            <a class="mark-button" href="/project/member/delete/1">&#10006;</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Владислав</td>
                        <td>
                            <select name="" class="auth-form__input">
                                <option value="member">Участник</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </td>
                        <td>
                            <a class="mark-button" href="/project/member/delete/1">&#10006;</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Владислав</td>
                        <td>
                            <select name="" class="auth-form__input">
                                <option value="member">Участник</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </td>
                        <td>
                            <a class="mark-button" href="/project/member/delete/1">&#10006;</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Владислав</td>
                        <td>
                            <select name="" class="auth-form__input">
                                <option value="member">Участник</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </td>
                        <td>
                            <a class="mark-button" href="/project/member/delete/1">&#10006;</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Владислав</td>
                        <td>
                            <select name="" class="auth-form__input">
                                <option value="member">Участник</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </td>
                        <td>
                            <a class="mark-button" href="/project/member/delete/1">&#10006;</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Владислав</td>
                        <td>
                            <select name="" class="auth-form__input">
                                <option value="member">Участник</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </td>
                        <td>
                            <a class="mark-button" href="/project/member/delete/1">&#10006;</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Владислав</td>
                        <td>
                            <select name="" class="auth-form__input">
                                <option value="member">Участник</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </td>
                        <td>
                            <a class="mark-button" href="/project/member/delete/1">&#10006;</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Владислав</td>
                        <td>
                            <select name="" class="auth-form__input">
                                <option value="member">Участник</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </td>
                        <td>
                            <a class="mark-button" href="/project/member/delete/1">&#10006;</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Владислав</td>
                        <td>
                            <select name="" class="auth-form__input">
                                <option value="member">Участник</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </td>
                        <td>
                            <a class="mark-button" href="/project/member/delete/1">&#10006;</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Владислав</td>
                        <td>
                            <select name="" class="auth-form__input">
                                <option value="member">Участник</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </td>
                        <td>
                            <a class="mark-button" href="/project/member/delete/1">&#10006;</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Владислав</td>
                        <td>
                            <select name="" class="auth-form__input">
                                <option value="member">Участник</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </td>
                        <td>
                            <a class="mark-button" href="/project/member/delete/1">&#10006;</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Владислав</td>
                        <td>
                            <select name="" class="auth-form__input">
                                <option value="member">Участник</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </td>
                        <td>
                            <a class="mark-button" href="/project/member/delete/1">&#10006;</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Владислав</td>
                        <td>
                            <select name="" class="auth-form__input">
                                <option value="member">Участник</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </td>
                        <td>
                            <a class="mark-button" href="/project/member/delete/1">&#10006;</a>
                        </td>
                    </tr>
                </table>
            </div>
    </main>
@endsection

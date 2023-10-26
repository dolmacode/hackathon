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
        <h4 class="align-center">@if(empty($project)) Создать проект @else Редактировать проект @endif</h4>
        <form class="auth-form" method="post" action="/project/save">
            @if(!empty($project)) <input type="hidden" name="project_id" value="{{ $project->id }}"> @endif
            @csrf
            <label>Название проекта</label>
            <input class="auth-form__input" name="name" @if(!empty($project)) value="{{ $project->name }}" @endif required>
            <textarea name="description" class="auth-form__input textarea">@if(!empty($project)) {{ $project->description }} @endif</textarea>
            <button class="primary-button">Сохранить</button>
        </form>

        @if(!empty($project))
            <div class="project__members">
                <form method="post" class="auth-form" action="/project/member/invite/{{ $project->id }}">
                    @csrf
                    <span>Пригласите участников в проект:</span>
                    <input type="email" class="auth-form__input" name="email" required>
                    <button class="primary-button">Пригласить</button>
                </form>
                @if(!empty($project->members))
                <table class="table">
                    <tr>
                        <th>Имя</th>
                        <th>Роль</th>
                        <th>Удалить</th>
                    </tr>
                    @foreach($project->members as $member)
                    <tr>
                        <td>{{ $member->user->name }}</td>
                        <td>
                            <select name="role" onchange="changeUserRoleAjax({{ $member->id }}, this.value)" class="auth-form__input">
                                @foreach($roles as $role)
                                <option @if($role->role == $member->role) selected @endif value="{{ $role->role }}">{{ $role->role_title }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <a class="mark-button" href="/project/member/delete/{{ $member->id }}">&#10006;</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                @endif
            </div>
        @endif
    </main>
@endsection

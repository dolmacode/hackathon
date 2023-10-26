@extends('layouts.main')

@php
    $page_title = "Отчетность проекта"
@endphp

@section('content')
    <style>
        body, html {
            overflow-y: scroll;
        }
    </style>
    <main class="project-profile">
        <h4 class="align-center">Отчетность</h4>

        <div class="d-flex flex-row justify-space-between">
            <div class="alert">
                <h3>{{ $tasks_count }}</h3>
                <p>Всего задач</p>
            </div>

            <div class="alert">
                <h3>{{ $completed_tasks_count }}</h3>
                <p>Всего задач</p>
            </div>
        </div>

        <div class="d-flex flex-column">
            @if($tasks_count > 0) <p>Выполнено {{ $completed_tasks_count / $tasks_count * 100 }}% от общего количества</p>@endif
            <progress style="height:50px;width: 100%" value="{{ $completed_tasks_count }}" max="{{ $tasks_count }}"></progress>
        </div>

        <table class="table">
            <tr>
                <th>Задача</th>
                <th>Дата создания задачи</th>
                <th>Дата изменения задачи</th>
                <th>Выполнено/Не выполнено</th>
            </tr>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->name }}</td>
                <td>{{ $task->created_at }}</td>
                <td>{{ $task->updated_at }}</td>
                <td>
                    @if($task->is_completed)
                    <span class="text-success">Выполнено</span>
                    @else
                    <span class="text-danger">Не выполнено</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </main>
@endsection

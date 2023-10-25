@extends('layouts.main')

@php
    $page_title = "Рабочий стол"
@endphp

@section('content')
    <main class="board">
        @include('components.projects-sidebar')

        <div class="board__content">
            @if(!empty($project->statuses))
                @foreach($project->statuses as $status)
                <div class="board__content-column">
                    <div class="board__content-column-header">
                        {{ $status->name }}
                    </div>
                    @foreach($status->tasks as $task)
                    <div data-bs-toggle="modal" onclick="showTaskProfile({{ $task->id }})" data-bs-target="#task_profile" class="board__content-column-item task">
                        <div class="task__header">
                            <h4>{{ $task->name }}</h4>
                            <a class="mark-button @if($task->is_completed) active @endif" href="/task/mark_as_completed/{{ $task->id }}">✓</a>
                        </div>
                        <span class="task__deadline">
                            до {{ str_replace('-', '.', explode(' ', $task->deadline)[0]); }}
                        </span>
                    </div>
                    @endforeach
                </div>
                @endforeach
            @else
                <div class="d-flex flex-column">
                    <div class="alert alert-warning">
                        Для отображения актуальных задач выберите один из своих проектов
                    </div>
                </div>
            @endif
        </div>
    </main>

    @include('components.tasks.profile')
@endsection

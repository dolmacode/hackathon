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

                    @php
                        // sorting of tasks by deadline

                        $tasks = $status->tasks;

                        if (!empty($_GET['sort'])) {
                            $tasks_keys = [];

                            foreach ($status->tasks as $item) {
                                $tasks_keys[strtotime($item->deadline)] = $item;
                            }

                            ksort($tasks_keys);

                            if ($_GET['sort'] == 'desc') {
                                $tasks_keys = array_reverse($tasks_keys);
                            }

                            $tasks = [];

                            foreach ($tasks_keys as $tk) {
                                $tasks[] = $tk;
                            }
                        }
                    @endphp

                    @foreach($tasks as $task)
                    <div class="board__content-column-item task">
                        <div class="task__header">
                            <h4 data-bs-toggle="modal" onclick="showTaskProfile({{ $task->id }})" data-bs-target="#task_profile">{{ $task->name }}</h4>
                            <a style="z-index: 100" class="mark-button @if($task->is_completed) active @endif" href="/task/mark_as_completed/{{ $task->id }}">✓</a>
                        </div>
                        <span data-bs-toggle="modal" onclick="showTaskProfile({{ $task->id }})" data-bs-target="#task_profile" class="task__deadline">
                            до {{ str_replace('-', '.', explode(' ', $task->deadline)[0]) }}
                        </span>
                        <span data-bs-toggle="modal" onclick="showTaskProfile({{ $task->id }})" data-bs-target="#task_profile" class="task__deadline">
                            <span class="
                            @switch($task->priority)
                            @case('Низкий')
                            text-success
                            @break;
                            @case('Средний')
                            text-warning
                            @break;
                            @case('Высокий')
                            text-danger
                            @break;
                            @endswitch
                            ">
                            {{ $task->priority }} приоритет
                            </span>
                        </span>
                        <span data-bs-toggle="modal" onclick="showTaskProfile({{ $task->id }})" data-bs-target="#task_profile" class="task__deadline">
                            {{ count($task->members) }} участник(-ов)
                        </span>
                        <span data-bs-toggle="modal" onclick="showTaskProfile({{ $task->id }})" data-bs-target="#task_profile" class="task__deadline">
                            {{ count($task->comments) }} комментариев
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
    @include('components.tasks.create')
@endsection

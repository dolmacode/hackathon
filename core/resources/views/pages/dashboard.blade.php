@extends('layouts.main')

@php
    $page_title = "Рабочий стол"
@endphp

@section('content')
    <main class="board">
        @include('components.projects-sidebar')

        <div class="board__content">
            @if(!empty($categories))
            <div class="board__content-column">
                <div class="board__content-column-header">
                    To Do
                </div>

                <div data-bs-toggle="modal" data-bs-target="#exampleModal" class="board__content-column-item task">
                    <div class="task__header">
                        <h4>Заголовок</h4>
                        <a class="mark-button active" href="/task/mark_as_completed/1">✓</a>
                    </div>
                    <span class="task__deadline">
                        до 23.10.2023
                    </span>
                </div>

            </div>
            @endif
        </div>
    </main>

    @include('components.tasks.profile')
@endsection

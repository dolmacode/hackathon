<aside class="board__sidebar">
    <!--@if(isset($completed_tasks_count, $tasks_count))
    <h5 class="board__sidebar-heading">Статистика</h5>
    @if(!empty($completed_tasks_count))<p>Выполненных: {{ $completed_tasks_count }} шт.</p>@endif
    @if(!empty($tasks_count))<p>Всего: {{ $tasks_count }} шт.</p>@endif
    @endif-->

    <div class="board__sidebar-sort">
        <h5 class="board__sidebar-heading">Сортировка</h5>
        <small>
            <p>По дедлайну:</p>
            <a href="?" class="link">По умолчанию</a><br>
            <a href="?sort=asc" class="link">По возрастанию</a><br>
            <a href="?sort=desc" class="link">По убыванию</a><br><hr>
        </small>
    </div>

    <a href="/project/create" class="secondary-button mb-1">Добавить проект</a>
    <button type="button" class="primary-button mb-5" data-bs-toggle="modal" data-bs-target="#task_create">Добавить задачу</button>

    <h3 class="board__sidebar-heading">Проекты:</h3>

    <menu class="board__sidebar-menu">

        @foreach($projects as $project)
        <div class="d-flex flex-row align-items-center justify-content-between">
            <a href="/dashboard/board-{{ $project->id }}" class="board__sidebar-menu-item">
                <span>{{ $project->name }}</span>
            </a>
            <a href="/project/{{ $project->id }}" class="mark-button">
                <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     width="10" height="10" viewBox="0 0 528.899 528.899"
                     xml:space="preserve">
                <g>
                    <path d="M328.883,89.125l107.59,107.589l-272.34,272.34L56.604,361.465L328.883,89.125z M518.113,63.177l-47.981-47.981
                        c-18.543-18.543-48.653-18.543-67.259,0l-45.961,45.961l107.59,107.59l53.611-53.611
                        C532.495,100.753,532.495,77.559,518.113,63.177z M0.3,512.69c-1.958,8.812,5.998,16.708,14.811,14.565l119.891-29.069
                        L27.473,390.597L0.3,512.69z"/>
                </g>
                </svg>
            </a>
        </div>
        @endforeach
    </menu>
</aside>

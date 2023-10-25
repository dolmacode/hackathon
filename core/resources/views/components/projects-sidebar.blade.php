<aside class="board__sidebar">
    <h3 class="board__sidebar-heading">Проекты:</h3>

    <menu class="board__sidebar-menu">
        <a href="/project/create" class="primary-button mb-5">Добавить проект</a>

        @foreach($projects as $project)
        <a href="/dashboard/board-{{ $project->id }}" class="board__sidebar-menu-item">{{ $project->name }}</a>
        @endforeach
    </menu>
</aside>

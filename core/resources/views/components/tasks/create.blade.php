<div class="modal fade modal-xl" id="task_create" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body task-modal">
                <form method="post" class="task__form" action="/task/save">
                    @csrf
                    <h4 class="task-comments__heading">Задача</h4>

                    @if (!empty($project))
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    @endif
                    <label>Название задачи</label>
                    <input type="text" class="task__input" name="name" value="" required placeholder="Наименование задачи">
                    <label>Срок сдачи</label>
                    <input type="date" class="task__input" name="deadline" required value="">
                    <label>Ценность</label>
                    <select class="task__input" name="task_cost_id">
                        @if (!empty($task_costs))
                        @foreach($task_costs as $cost)
                            <option value="{{ $cost->id }}">{{ $cost->name }}</option>
                        @endforeach
                        @endif
                    </select>
                    <label>Приоритет задачи</label>
                    <select class="task__input" name="priority" required>
                        <option value="Низкий">Низкий</option>
                        <option value="Средний">Средний</option>
                        <option value="Высокий">Высокий</option>
                    </select>
                    <label>Статус</label>
                    <select class="task__input" name="status" required>
                        @if (!empty($statuses))
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                        @endif
                    </select>
                    <label>Категория</label>
                    <select class="task__input" name="category_id">
                        @if (!empty($categories))
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        @endif
                    </select>
                    <label>Описание задачи</label>
                    <textarea class="task__input textarea" name="description"></textarea>

                    <button class="primary-button" data-bs-dismiss="modal">Сохранить</button>
                </form>

                <div class="task__comments">
                    <h4 class="task-comments__heading">Комментарии к задаче</h4>
                    <span class="d-flex flex-column">
                        <span class="alert alert-warning">
                            Сначала создайте задачу
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

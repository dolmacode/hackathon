<div class="modal fade modal-xl" id="task_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body task-modal">
                <form method="post" class="task__form" action="/task/save">
                    @csrf
                    <h4 class="task-comments__heading">Задача</h4>

                    <input id="task_id_input" type="hidden" name="task_id" value="">
                    <label>Название задачи</label>
                    <input id="task_name_input" type="text" class="task__input" name="name" value="" required placeholder="Наименование задачи">
                    <label>Срок сдачи</label>
                    <input id="task_deadline_input" type="date" class="task__input" name="deadline" value="">
                    <label>Ценность</label>
                    <select id="task_cost_input" class="task__input" name="task_cost_id">
                        @foreach($task_costs as $cost)
                            <option value="{{ $cost->id }}">{{ $cost->name }}</option>
                        @endforeach
                    </select>
                    <label>Приоритет задачи</label>
                    <select id="task_priority_input" class="task__input" name="priority" required>
                        <option value="Низкий">Низкий</option>
                        <option value="Средний">Средний</option>
                        <option value="Высокий">Высокий</option>
                    </select>
                    <label>Статус</label>
                    <select id="task_status_input" class="task__input" name="status" required>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                    <label>Категория</label>
                    <select id="task_category_input" class="task__input" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label>Описание задачи</label>
                    <textarea id="task_description_input" class="task__input textarea" name="description"></textarea>

                    <button class="secondary-button" data-bs-dismiss="modal">Сохранить</button>
                </form>

                <div class="task__comments">
                    <h5 class="task-comments__heading">Исполнители</h5>
                    <form method="post" action="/task/members/add">
                        @csrf
                        <input type="hidden" name="task_id" id="task_member_id_input">
                        <select name="user_id" class="auth-form__input">
                            @foreach($project->members as $member)
                                <option value="{{ $member->user->id }}">{{ $member->user->name }}</option>
                            @endforeach
                        </select>

                        <button class="primary-button">Добавить</button>
                    </form>

                    <p id="task_members_list"></p>

                    <hr>

                    <h5 class="task-comments__heading">Комментарии к задаче</h5>
                    <form method="post" action="/task/comment/add">
                        @csrf
                        <input type="hidden" name="task_id" id="task_comment_id_input">
                        <input type="text" name="text_content" class="task__input" placeholder="Напишите что-нибудь..." required>
                        <button class="primary-button">Отправить</button>
                    </form>
                    <div class="task__comments-list"></div>
                </div>
            </div>
        </div>
    </div>
</div>

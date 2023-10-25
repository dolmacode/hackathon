<div class="modal fade modal-xl" id="task_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Заголовок задачи</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body task-modal">
                <form method="post" class="task__form" action="/task/save">
                    <h4 class="task-comments__heading">Задача</h4>

                    <input type="hidden" name="task_id" value="">
                    <label>Название задачи</label>
                    <input type="text" class="task__input" name="name" value="" required placeholder="Наименование задачи">
                    <label>Срок сдачи</label>
                    <input type="date" class="task__input" name="deadline" value="">
                    <label>Ценность</label>
                    <select class="task__input" name="task_cost_id">
                        <option value="1">Низкая</option>
                        <option value="2">Средняя</option>
                        <option value="3">Высокая</option>
                    </select>
                    <label>Приоритет задачи</label>
                    <select class="task__input" name="priority">
                        <option value="1">Низкая</option>
                        <option value="2">Средняя</option>
                        <option value="3">Высокая</option>
                    </select>
                    <label>Статус</label>
                    <select class="task__input" name="status">
                        <option value="in_work">В работе</option>
                        <option value="wait">Отложено</option>
                        <option value="completed">Завершено</option>
                    </select>
                    <label>Описание задачи</label>
                    <textarea class="task__input textarea" name="description"></textarea>

                    <button class="primary-button" data-bs-dismiss="modal">Сохранить</button>
                </form>

                <div class="task__comments">
                    <h4 class="task-comments__heading">Комментарии к задаче</h4>
                    <form method="post" action="/task/comment/add">
                        <input type="text" name="content" class="task__input" placeholder="Напишите что-нибудь..." required>
                        <button class="primary-button">Отправить</button>
                    </form>

                    <div class="task__comments-item">
                        <h6>Имя пользователя</h6>
                        <p>anwidjaw aoiwdniawd aiwdaoiwd iawndoiaw  ianwdoiinaw iawndoa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

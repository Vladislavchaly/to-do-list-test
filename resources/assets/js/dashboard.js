$(document).ready(async function () {
    const $tasks = $('#tasks');
    const $taskForm = $('#task-form');
    const $taskModal = $('#task-modal');
    const $taskModalTitle = $('#task-modal-title');
    const $logoutButton = $('#logout-button');

    $logoutButton.on('click', function () {
        window.ApiService.delete('/auth/logout')
            .then(() => {
                alert('Logged out successfully.');
                localStorage.removeItem('access_token');
                window.location.href = '/login';
            })
            .catch(error => {
                alert('Logout failed. Please try again.');
            });
    });

    async function loadTasks() {
        try {
            const response = await window.ApiService.get('/task?sort_by=status');
            const tasks = response.data;

            $tasks.empty();
            tasks.forEach(task => {
                $tasks.append(`
                    <li class="list-group-item">
                        <strong>${task.name}</strong>
                        <span>${task.description}</span>
                        <div class="btn-group float-right">
                            <button class="btn btn-sm btn-warning edit-task" data-id="${task.id}">Edit</button>
                            <button class="btn btn-sm btn-danger delete-task" data-id="${task.id}">Delete</button>
                            <button class="btn btn-sm ${task.status ? 'btn-success' : 'btn-secondary'} update-status" data-id="${task.id}" data-status="${!task.completed}">
                                ${task.status ? 'Mark Incomplete' : 'Mark Complete'}
                            </button>
                        </div>
                    </li>
                `);
            });
        } catch (error) {
            alert('Failed to load tasks: ' + error.message);
        }
    }

    $('#add-task-btn').click(() => {
        $taskModalTitle.text('Create Task');
        $taskForm[0].reset();
        $('#task-id').val('');
        $taskModal.modal('show');
    });

    $tasks.on('click', '.edit-task', async function () {
        const taskId = $(this).data('id');
        try {
            const task = await window.ApiService.get(`/task/${taskId}`);
            $('#task-id').val(task.id);
            $('#task-name').val(task.name);
            $('#task-desc').val(task.description);
            $taskModalTitle.text('Edit Task');
            $taskModal.modal('show');
        } catch (error) {
            alert('Failed to load task: ' + error.message);
        }
    });

    $tasks.on('click', '.delete-task', async function () {
        const taskId = $(this).data('id');
        if (confirm('Are you sure you want to delete this task?')) {
            try {
                await window.ApiService.delete(`/task/${taskId}`);
                loadTasks();
            } catch (error) {
                alert('Failed to delete task: ' + error.message);
            }
        }
    });

    $tasks.on('click', '.update-status', async function () {
        const taskId = $(this).data('id');
        const newStatus = $(this).data('status');
        try {
            await window.ApiService.patch(`/task/status/${taskId}`, { status: newStatus });
            loadTasks();
        } catch (error) {
            alert('Failed to update task status: ' + error.message);
        }
    });

    $taskForm.submit(async function (e) {
        e.preventDefault();
        const taskId = $('#task-id').val();
        const taskData = {
            name: $('#task-name').val(),
            description: $('#task-desc').val()
        };
        try {
            if (taskId) {
                await window.ApiService.put(`/task/${taskId}`, taskData);
            } else {
                await window.ApiService.post('/task', taskData);
            }
            $taskModal.modal('hide');
            loadTasks();
        } catch (error) {
            alert('Failed to save task: ' + error.message);
        }
    });

    loadTasks();
});

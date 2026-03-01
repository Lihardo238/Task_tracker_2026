@extends('navbar.admin')

@section('content')

<div class="container mt-4">

    <h3>Personal Task Manager</h3>

    <div class="card p-3 mb-4">
        <h5>Add New Task</h5>

        <form id="taskForm">
            @csrf

            <input type="text" name="title" class="form-control mb-2" placeholder="Task Title" required>

            <textarea name="deskripsi" class="form-control mb-2" placeholder="Description" required></textarea>

            <input type="date" name="dueDate" class="form-control mb-2" required>

            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>
    </div>

    <div id="taskContainer" class="row"></div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const taskContainer = document.getElementById('taskContainer');
    const taskForm = document.getElementById('taskForm');

    function loadTasks() {
        fetch("{{ route('tasks.list') }}")
            .then(res => res.json())
            .then(data => {
                taskContainer.innerHTML = '';

                data.forEach(task => {
                    taskContainer.innerHTML += `
                        <div class="col-md-4 mb-3">
                            <div class="card p-3">
                                <h5>${task.title}</h5>
                                <p>${task.deskripsi}</p>
                                <small>Due: ${task.dueDate}</small><br>

                                <select class="form-select mt-2" 
                                    onchange="updateStatus(${task.id}, this.value)">
                                    <option value="pending" ${task.status == 'pending' ? 'selected' : ''}>Pending</option>
                                    <option value="on-going" ${task.status == 'on-going' ? 'selected' : ''}>On Going</option>
                                    <option value="completed" ${task.status == 'completed' ? 'selected' : ''}>Completed</option>
                                    <option value="cancelled" ${task.status == 'cancelled' ? 'selected' : ''}>Cancelled</option>
                                </select>
                            </div>
                        </div>
                    `;
                });
            });
    }

    loadTasks();

    taskForm.addEventListener('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(taskForm);

        fetch("{{ route('tasks.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            taskForm.reset();
            loadTasks(); 
        });
    });

});

function updateStatus(id, status) {

    fetch(`/personal-tasks/${id}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ status: status })
    })
    .then(res => res.json())
    .then(data => {
        console.log('Status Updated');
    });
}
</script>

@endsection
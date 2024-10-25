@extends('base')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h2>Dashboard</h2>
        <button id="add-task-btn" class="btn btn-primary mb-3">Add New Task</button>
        <button id="logout-button" class="btn btn-danger mb-3">Logout</button>

        <div id="task-list" class="mt-4">
            <h3>Your Tasks</h3>
            <ul id="tasks" class="list-group"></ul>
        </div>

        <div id="task-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="task-modal-title">Create Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="task-form">
                            <input type="hidden" id="task-id">
                            <div class="form-group">
                                <label for="task-name">Name</label>
                                <input type="text" id="task-name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="task-desc">Description</label>
                                <textarea id="task-desc" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Save Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection

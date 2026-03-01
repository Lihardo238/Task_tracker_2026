@extends('navbar.admin')

@section('content')
<div class="container">

    <h3 class="mb-3">User Management</h3>

    <div id="loading" class="text-center mb-2" style="display:none;">
        <strong>Loading...</strong>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th width="160">Actions</th>
            </tr>
        </thead>
        <tbody id="userTableBody"></tbody>
    </table>

    <div class="d-flex justify-content-center" id="paginationLinks"></div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    loadUsers();

    function showLoading(show = true) {
        document.getElementById("loading").style.display = show ? "block" : "none";
    }

    function loadUsers(page = 1) {
        showLoading(true);

        fetch(`/users/list?page=${page}`, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => response.json())
        .then(data => {
            renderTable(data.data);
            renderPagination(data);
            showLoading(false);
        })
        .catch(error => {
            console.error(error);
            showLoading(false);
        });
    }

    function renderTable(users) {
        let tbody = document.getElementById("userTableBody");
        tbody.innerHTML = "";

        if (users.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center">No users found</td>
                </tr>
            `;
            return;
        }

        users.forEach(user => {
            tbody.innerHTML += `
                <tr>
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.role}</td>
                    <td>${user.status}</td>
                    <td>
                        <div class="btn-group">
                            <a href="/users/${user.id}/edit"
                               class="btn btn-warning btn-sm">
                               Edit
                            </a>

                            <button class="btn btn-danger btn-sm"
                                    onclick="deleteUser(${user.id})">
                                    Delete
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });
    }

    function renderPagination(data) {
        let pagination = document.getElementById("paginationLinks");
        pagination.innerHTML = "";

        for (let i = 1; i <= data.last_page; i++) {
            pagination.innerHTML += `
                <button class="btn btn-sm ${i === data.current_page ? 'btn-primary' : 'btn-outline-primary'} m-1"
                        onclick="loadUsers(${i})">
                        ${i}
                </button>
            `;
        }
    }

    window.loadUsers = loadUsers;

    window.deleteUser = function(id) {
        if (!confirm("Are you sure you want to delete this user?")) {
            return;
        }

        fetch(`/users/${id}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => response.json())
        .then(data => {
            loadUsers();
        })
        .catch(error => console.error(error));
    }

});
</script>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/create-users.css') }}">
@endpush
@extends('app.adminApp')

@section('content')
<div class="container">
    
    <!-- Data Table for Users -->
    <table class="table table-bordered table-striped" id="table_userList">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Contact Identity</th>
                <th>Contact Number</th>
                <th>Fax / Email</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="userTableBody"></tbody>
    </table>
    
    <!-- Pagination Links -->
    <div class="d-flex justify-content-center" id="paginationLinks"></div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    loadUsers();

    function loadUsers(page = 1) {
        fetch(`/partnership?page=${page}`, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => response.json())
        .then(data => {
            renderTable(data.data);
            renderPagination(data);
        });
    }

    function renderTable(users) {
        let tbody = document.getElementById("userTableBody");
        tbody.innerHTML = "";

        users.forEach(partnership => {
            tbody.innerHTML += `
                <tr>
                    <td>${partnership.id}</td>
                    <td>${partnership.name}</td>
                    <td>${partnership.contact_identity}</td>
                    <td>${partnership.contact_number}</td>
                    <td>${partnership.fax_email}</td>
                    <td>${partnership.description}</td>
                    <td>
                        <a href="/users/${user.id}/edit" class="btn btn-warning btn-sm">Edit</a>
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
                <button class="btn btn-sm btn-outline-primary m-1"
                    onclick="loadUsers(${i})">
                    ${i}
                </button>
            `;
        }
    }

    window.loadUsers = loadUsers;
});
</script>
@endsection

@extends('navbar.admin')

@section('content')
<div class="container">
    <h1>Edit User</h1>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('users.update', $user->id) }}" method="POST" id="editUserForm">
        @csrf
        @method('PUT')
        
        {{-- Name --}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text"
                   id="name"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $user->name) }}"
                   required>
        </div>
        
        {{-- Email --}}
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email"
                   id="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email', $user->email) }}"
                   required>
        </div>
        
        {{-- Role --}}
        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" class="form-control" required>
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="pm" {{ old('role', $user->role) === 'pm' ? 'selected' : '' }}>Project Manager</option>
                <option value="worker" {{ old('role', $user->role) === 'worker' ? 'selected' : '' }}>Worker</option>
            </select>
        </div>

        {{-- Status --}}
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control" required>
                <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $user->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        
        {{-- Password (Optional) --}}
        <div class="form-group">
            <label for="password">Password (leave blank to keep current password)</label>
            <input type="password"
                   id="password"
                   name="password"
                   class="form-control">
        </div>
        
        {{-- Confirm Password --}}
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password"
                   id="password_confirmation"
                   name="password_confirmation"
                   class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">
            Update User
        </button>
    </form>
</div>

<script>
    document.getElementById('editUserForm').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;
        const passwordError = document.createElement('div');
        passwordError.className = 'alert alert-danger';
        
        // Clear any previous error messages
        const previousErrors = document.querySelectorAll('.alert.alert-danger');
        previousErrors.forEach(error => error.remove());
        
        let hasError = false;
        
        if (password.length > 0 && password.length < 8) {
            passwordError.textContent = 'Password must be at least 8 characters long.';
            document.getElementById('password').parentNode.appendChild(passwordError);
            hasError = true;
        }
        
        if (password !== passwordConfirmation) {
            const confirmationError = document.createElement('div');
            confirmationError.className = 'alert alert-danger';
            confirmationError.textContent = 'Password and confirmation do not match.';
            document.getElementById('password_confirmation').parentNode.appendChild(confirmationError);
            hasError = true;
        }
        
        if (hasError) {
            event.preventDefault();
        }
    });
</script>
@endsection
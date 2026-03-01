@extends('navbar.admin')

@section('content')
<div class="container">
    <h1>Create User</h1>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST" id="createUserForm">
        @csrf

        {{-- Name --}}
        <div class="form-group mb-3">
            <label>Name</label>
            <input type="text" 
                   name="name" 
                   class="form-control" 
                   value="{{ old('name') }}" 
                   required>
        </div>

        {{-- Email --}}
        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" 
                   name="email" 
                   class="form-control" 
                   value="{{ old('email') }}" 
                   required>
        </div>

        {{-- Role --}}
        <div class="form-group mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="">-- Select Role --</option>
                <option value="admin">Admin</option>
                <option value="executive">Executive</option>
                <option value="pm">Project Manager</option>
                <option value="worker">Worker</option>
            </select>
        </div>

        {{-- Status --}}
        <div class="form-group mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="">-- Select Status --</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        {{-- Password --}}
        <div class="form-group mb-3">
            <label>Password</label>
            <input type="password" 
                   id="password"
                   name="password" 
                   class="form-control" 
                   required>
        </div>

        {{-- Confirm Password --}}
        <div class="form-group mb-3">
            <label>Confirm Password</label>
            <input type="password" 
                   id="password_confirmation"
                   name="password_confirmation" 
                   class="form-control" 
                   required>
        </div>

        <button type="submit" class="btn btn-primary">
            Create User
        </button>
    </form>
</div>

<script>
    document.getElementById('createUserForm').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;
        const passwordError = document.createElement('div');
        passwordError.className = 'alert alert-danger';
        
        // Clear any previous error messages
        const previousErrors = document.querySelectorAll('.alert.alert-danger');
        previousErrors.forEach(error => error.remove());
        
        let hasError = false;
        
        if (password.length < 8) {
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 flex items-center justify-center p-6">

    <div class="w-full max-w-xl bg-white/90 backdrop-blur-lg shadow-2xl rounded-3xl p-10 animate-fade-in">

        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800">Create New User</h2>
            <p class="text-gray-500 text-sm mt-2">Register a new account to the system</p>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-5 p-4 rounded-xl bg-green-100 border border-green-300 text-green-700 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="mb-5 p-4 rounded-xl bg-red-100 border border-red-300 text-red-700 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Name --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full mt-2 px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 transition duration-200"
                    placeholder="Enter full name" required>
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full mt-2 px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 transition duration-200"
                    placeholder="example@email.com" required>
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700">Password</label>
                <input type="password" name="password"
                    class="w-full mt-2 px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 transition duration-200"
                    placeholder="Minimum 8 characters" required>
            </div>

            {{-- Confirm Password --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full mt-2 px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 transition duration-200"
                    placeholder="Repeat password" required>
            </div>

            {{-- Role --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700">Role</label>
                <select name="role"
                    class="w-full mt-2 px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 transition duration-200"
                    required>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="executive" {{ old('role') == 'executive' ? 'selected' : '' }}>Executive</option>
                    <option value="pm" {{ old('role') == 'pm' ? 'selected' : '' }}>Project Manager</option>
                    <option value="worker" {{ old('role', 'worker') == 'worker' ? 'selected' : '' }}>Worker</option>
                </select>
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700">Status</label>
                <select name="status"
                    class="w-full mt-2 px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 transition duration-200"
                    required>
                    <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit"
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold shadow-lg hover:scale-[1.02] hover:shadow-xl transition duration-300">
                    Register User
                </button>
            </div>
        </form>
    </div>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

</body>
</html>
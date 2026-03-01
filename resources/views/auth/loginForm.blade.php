<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 flex items-center justify-center p-6">

    <div class="w-full max-w-md bg-white/90 backdrop-blur-lg shadow-2xl rounded-3xl p-10 animate-fade-in">

        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800">Welcome Back</h2>
            <p class="text-gray-500 text-sm mt-2">Login to continue to your dashboard</p>
        </div>

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

        <form action="{{ route('login-confirmation') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Email --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full mt-2 px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 transition duration-200"
                    placeholder="example@email.com"
                    required>
            </div>

            {{-- Password --}}
            <div class="relative">
                <label class="block text-sm font-semibold text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full mt-2 px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 transition duration-200"
                    placeholder="Enter your password"
                    required>

                <button type="button"
                        onclick="togglePassword()"
                        class="absolute right-3 top-11 text-gray-500 text-sm hover:text-indigo-600">
                    Show
                </button>
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="remember"
                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span class="text-gray-600">Remember me</span>
                </label>

                <a href="#" class="text-indigo-600 hover:underline">
                    Forgot password?
                </a>
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit"
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold shadow-lg hover:scale-[1.02] hover:shadow-xl transition duration-300">
                    Login
                </button>
            </div>
        </form>

    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const button = event.target;

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                button.innerText = "Hide";
            } else {
                passwordInput.type = "password";
                button.innerText = "Show";
            }
        }
    </script>

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
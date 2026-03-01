<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TaskTracker - Organize Your Work</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN (for quick setup) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-primary">TaskTracker</h1>

            <div class="hidden md:flex space-x-6">
                <a href="#features" class="hover:text-primary">Features</a>
                <a href="#about" class="hover:text-primary">About</a>
                <a href="{{ route('login') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                    Login
                </a>
            </div>

            <!-- Mobile Button -->
            <button id="menuBtn" class="md:hidden text-2xl">
                ☰
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white px-6 pb-4">
            <a href="#features" class="block py-2">Features</a>
            <a href="#about" class="block py-2">About</a>
            <a href="{{ route('login') }}" class="block bg-primary text-white px-4 py-2 rounded-lg mt-2 text-center">
                Login
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-6xl font-bold mb-6">
                Organize Your Tasks.
                <br> Boost Your Productivity.
            </h2>
            <p class="text-lg md:text-xl mb-8">
                Manage personal and team tasks efficiently with deadlines,
                checkpoints, and progress tracking.
            </p>
            <a href="{{ route('register') }}"
               class="bg-white text-primary font-semibold px-8 py-3 rounded-lg shadow-lg hover:bg-gray-100 transition">
                Get Started
            </a>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-20 bg-gray-100">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-12">Features</h3>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
                    <h4 class="text-xl font-semibold mb-4">Task Management</h4>
                    <p>Create, update, and organize tasks with statuses and deadlines.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
                    <h4 class="text-xl font-semibold mb-4">Project Collaboration</h4>
                    <p>Assign team members and manage project checkpoints easily.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
                    <h4 class="text-xl font-semibold mb-4">Progress Tracking</h4>
                    <p>Monitor completion rates and improve workflow efficiency.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="py-20">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-6">Why TaskTracker?</h3>
            <p class="text-lg text-gray-600">
                TaskTracker is designed for simplicity and productivity.
                Whether you are managing personal goals or team projects,
                our system helps you stay organized and focused.
            </p>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 bg-primary text-white text-center">
        <h3 class="text-3xl font-bold mb-6">Start Managing Tasks Today</h3>
        <a href="{{ route('register') }}"
           class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100">
            Create Account
        </a>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-6 text-center">
        © {{ date('Y') }} TaskTracker. All rights reserved.
    </footer>

    <!-- JS -->
    <script>
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href'))
                    .scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>

</body>
</html>
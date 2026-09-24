<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Task Manager') - Personal Task Manager</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script>
        // Load saved theme before the page appears
        const savedTheme = localStorage.getItem('task-manager-theme');

        if (savedTheme) {
            document.documentElement.setAttribute('data-theme', savedTheme);
        } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar">

        <div class="container nav-content">

            <!-- Brand -->
            <a href="{{ route('tasks.index') }}" class="brand">

                <span class="brand-icon">
                    ✓
                </span>

                <span class="brand-text">
                    Task<span>Flow</span>
                </span>

            </a>


            <!-- Navigation actions -->
            <div class="nav-actions">

                <!-- Theme toggle -->
                <button
                    type="button"
                    class="theme-toggle"
                    id="themeToggle"
                    aria-label="Toggle dark mode"
                >
                    <span class="theme-icon sun">☀</span>
                    <span class="theme-icon moon">☾</span>
                </button>


                @auth

                    <!-- User -->
                    <div class="user-info">

                        <div class="user-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <div class="user-details">
                            <strong>{{ auth()->user()->name }}</strong>
                            <small>Personal Workspace</small>
                        </div>

                    </div>

                    <!-- Logout -->
                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                        class="logout-form"
                    >
                        @csrf

                        <button type="submit" class="btn btn-logout">
                            Logout
                        </button>
                    </form>

                @endauth

            </div>

        </div>

    </nav>


    <!-- Main -->
    <main class="container main-content">

        <!-- Success message -->
        @if (session('success'))

            <div class="alert success">
                <span class="alert-icon">✓</span>

                <span>
                    {{ session('success') }}
                </span>
            </div>

        @endif


        <!-- Validation errors -->
        @if ($errors->any())

            <div class="alert error">

                <span class="alert-icon">!</span>

                <div>
                    <strong>Please fix the following:</strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>

        @endif


        @yield('content')

    </main>


    <!-- Footer -->
    <footer class="footer">

        <div class="container footer-content">

            <div>
                <strong>TaskFlow</strong>
                <span>Personal Task Manager</span>
            </div>

            <span>
                Built with Laravel
            </span>

        </div>

    </footer>


    <!-- Dark mode script -->
    <script>
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;

        function updateThemeButton() {
            const theme = html.getAttribute('data-theme');

            if (theme === 'dark') {
                themeToggle.setAttribute('aria-label', 'Switch to light mode');
            } else {
                themeToggle.setAttribute('aria-label', 'Switch to dark mode');
            }
        }

        themeToggle?.addEventListener('click', () => {

            const currentTheme = html.getAttribute('data-theme');

            const newTheme =
                currentTheme === 'dark'
                    ? 'light'
                    : 'dark';

            html.setAttribute('data-theme', newTheme);

            localStorage.setItem(
                'task-manager-theme',
                newTheme
            );

            updateThemeButton();
        });

        updateThemeButton();
    </script>

</body>
</html>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - TaskFlow</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script>
        const savedTheme = localStorage.getItem('task-manager-theme');

        if (savedTheme) {
            document.documentElement.setAttribute('data-theme', savedTheme);
        } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
</head>

<body class="auth-page">

    <div class="auth-background">
        <div class="auth-shape shape-one"></div>
        <div class="auth-shape shape-two"></div>
    </div>

    <main class="auth-container">

        <div class="auth-card">

            <!-- Brand -->
            <div class="auth-brand">
                <div class="brand-icon">
                    ✓
                </div>

                <div>
                    <strong>Task<span>Flow</span></strong>
                    <small>Personal Task Manager</small>
                </div>
            </div>


            <!-- Header -->
            <div class="auth-header">
                <h1>Welcome back</h1>

                <p>
                    Sign in to continue managing your tasks.
                </p>
            </div>


            <!-- Errors -->
            @if ($errors->any())

                <div class="auth-error">

                    <div class="error-icon">!</div>

                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>

                </div>

            @endif


            <!-- Login form -->
            <form
                method="POST"
                action="{{ route('login') }}"
                class="auth-form"
            >

                @csrf


                <!-- Email -->
                <div class="form-group">

                    <label for="email">
                        Email address
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        autocomplete="email"
                        required
                        autofocus
                    >

                </div>


                <!-- Password -->
                <div class="form-group">

                    <div class="label-row">

                        <label for="password">
                            Password
                        </label>

                    </div>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="auth-submit"
                >
                    Sign In
                    <span>→</span>
                </button>

            </form>


            <!-- Register -->
            <div class="auth-footer">

                <span>Don't have an account?</span>

                <a href="{{ route('register') }}">
                    Create one
                </a>

            </div>


            <!-- Theme -->
            <button
                type="button"
                class="auth-theme-toggle"
                id="authThemeToggle"
            >
                <span class="auth-sun">☀</span>
                <span class="auth-moon">☾</span>
                <span id="themeText">Dark mode</span>
            </button>

        </div>

    </main>


    <script>

        const authThemeToggle =
            document.getElementById('authThemeToggle');

        const themeText =
            document.getElementById('themeText');

        const html =
            document.documentElement;


        function updateAuthTheme() {

            const theme =
                html.getAttribute('data-theme');

            if (theme === 'dark') {

                themeText.textContent = 'Light mode';

            } else {

                themeText.textContent = 'Dark mode';

            }

        }


        authThemeToggle.addEventListener('click', function () {

            const currentTheme =
                html.getAttribute('data-theme');

            const newTheme =
                currentTheme === 'dark'
                    ? 'light'
                    : 'dark';

            html.setAttribute(
                'data-theme',
                newTheme
            );

            localStorage.setItem(
                'task-manager-theme',
                newTheme
            );

            updateAuthTheme();

        });


        updateAuthTheme();

    </script>

</body>
</html>
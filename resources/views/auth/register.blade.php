<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account - TaskFlow</title>

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

        <div class="auth-card auth-card-register">

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

                <h1>Create your account</h1>

                <p>
                    Start organizing your tasks today.
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


            <!-- Register form -->
            <form
                method="POST"
                action="{{ route('register') }}"
                class="auth-form"
            >

                @csrf


                <!-- Name -->
                <div class="form-group">

                    <label for="name">
                        Full name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Your name"
                        autocomplete="name"
                        required
                        autofocus
                    >

                </div>


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
                    >

                </div>


                <!-- Password -->
                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="At least 8 characters"
                        autocomplete="new-password"
                        required
                    >

                </div>


                <!-- Confirm password -->
                <div class="form-group">

                    <label for="password_confirmation">
                        Confirm password
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Enter your password again"
                        autocomplete="new-password"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="auth-submit"
                >
                    Create Account
                    <span>→</span>
                </button>

            </form>


            <!-- Login -->
            <div class="auth-footer">

                <span>Already have an account?</span>

                <a href="{{ route('login') }}">
                    Sign in
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
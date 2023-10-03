<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gold One Victory Lending App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <main>
        <!-- * The styles are in ./res/scss/modules/pages/_login.scss -->

        <!-- * Main Login Container -->
        <div class="login-container">

            <!-- * Login Form Wrapper -->
            <form class="login-wrapper" method="POST" action="{{ route('login') }}">
                @csrf
                <!-- * Logo -->
                <div class="logo-container">
                    <img src="{{ URL::to('/') }}/assets/icons/logo.svg" alt="GOVL logo" class="avatar" />
                </div>

                <!-- * Form Container -->
                <div class="container">

                    <div class="input-box">
                        <input type="text" name="username" required />
                        <span>Username</span>
                    </div>

                    @if (session('message'))
                        <span style="font-size: 18px; color: #ff8080;margin:1rem;"> {{ session('message') }}</span>
                    @endif

                    <div class="input-box">
                        <input type="password" name="password" required />
                        <span>Password</span>
                    </div>
                    <!-- * Form Buttons -->
                    <div class="wrapper">
                        <button type="submit" class="forgot-btn">Forgot Password</button>
                        <button type="submit" class="login-btn">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

</html>

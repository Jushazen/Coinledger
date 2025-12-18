<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coinledger - Personal Finance Tracker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white/90 backdrop-blur-sm shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/icons/logo.png') }}" alt="" class="w-16">
                    <span class="text-xl font-bold text-gray-800">Coinledger</span>
                </div>
                <div class="space-x-4">
                    <a href="{{ route('view.login') }}"
                        class="px-4 py-2 text-gray-700 hover:text-blue-400 font-medium transition-colors duration-200">
                        Login
                    </a>
                    <a href="{{ route('view.register') }}"
                        class="px-4 py-2 text-gray-700 hover:text-blue-400  font-medium transition-all duration-200 shadow-md">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white/90 backdrop-blur-sm py-4">
        <div class="container mx-auto px-6 text-center">
            <p class="text-gray-600 text-sm">
                &copy; {{ date('Y') }} Coinledger. Track your finances with confidence.
            </p>
        </div>
    </footer>
</body>

</html>
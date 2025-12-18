<x-auth>
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header with Logo -->
        <div class="p-6 text-center">
            <div class="flex items-center justify-center space-x-3 mb-4">
                <div class="w-16 h-10 bg-white rounded-lg flex items-center justify-center">
                    <img src="{{ asset('images/icons/logo.png') }}" alt="" class="w-16">
                </div>
                
                <h1 class="text-2xl font-bold text-gray-700">Coinledger</h1>
            </div>
            <p class="text-blue-300">Welcome back! Please login to your account</p>
        </div>

        <!-- Form Section -->
        <div class="p-8">
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" id="email" name="email" required
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('email') border-red-500 @enderror"
                            placeholder="Enter your email" value="{{ old('email') }}">
                    </div>
                    @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" required
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('password') border-red-500 @enderror"
                            placeholder="Enter your password">
                    </div>
                    @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end">
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800 transition-colors duration-200">
                        Forgot password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full  bg-blue-400 text-white font-medium py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Login to Account
                </button>
            </form>

            <!-- Error Messages -->
            @if ($errors->any())
            <div class="mt-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <h3 class="text-sm font-medium text-red-800 mb-2">Please check the following:</h3>
                <ul class="text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Registration Link -->
            <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('view.register') }}"
                        class="font-medium text-blue-600 hover:text-blue-800 transition-colors duration-200">
                        Create one now
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-auth>
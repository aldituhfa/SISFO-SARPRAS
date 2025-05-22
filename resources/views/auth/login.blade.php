<x-guest-layout>
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800">Welcome Back!</h2>
            <p class="text-gray-500">Login to your account</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Email Address -->
        <div>
            <label for="email" class="block mb-2 text-sm text-gray-700">Email</label>
            <input id="email" type="email" name="email" required autofocus
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block mb-2 text-sm text-gray-700">Password</label>
            <input id="password" type="password" name="password" required
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label class="flex items-center text-sm text-gray-600">
                <input type="checkbox" name="remember" class="mr-2">
                Remember Me
            </label>
            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Forgot Password?</a>
        </div>

        <button type="submit"
            class="w-full py-3 mt-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
            Login
        </button>

        <p class="text-center text-sm mt-4 text-gray-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register here</a>
        </p>
    </form>
</x-guest-layout>

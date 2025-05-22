<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800">Create an Account</h2>
            <p class="text-gray-500">Join us and start your journey</p>
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="block mb-2 text-sm text-gray-700">Full Name</label>
            <input id="name" type="text" name="name" required autofocus
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block mb-2 text-sm text-gray-700">Email</label>
            <input id="email" type="email" name="email" required
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block mb-2 text-sm text-gray-700">Password</label>
            <input id="password" type="password" name="password" required
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block mb-2 text-sm text-gray-700">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
        </div>

        <button type="submit"
            class="w-full py-3 mt-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
            Register
        </button>

        <p class="text-center text-sm mt-4 text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login here</a>
        </p>
    </form>
</x-guest-layout>

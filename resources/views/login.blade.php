<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] flex items-center justify-center min-h-screen px-4">
<div class="w-full max-w-md bg-white dark:bg-[#161615] dark:text-[#EDEDEC] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg shadow-md p-8">
    <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

    @if(session('error'))
        <div class="mb-4 text-red-600 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium mb-2">Email</label>
            <input type="email" name="email" id="email" required autofocus
                   value="{{ old('email') }}"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 bg-white dark:bg-[#1f1f1f] text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
            @error('email')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block text-sm font-medium mb-2">Password</label>
            <input type="password" name="password" id="password" required
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 bg-white dark:bg-[#1f1f1f] text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
            @error('password')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition duration-200">
            Log In
        </button>
    </form>
</div>
</body>
</html>

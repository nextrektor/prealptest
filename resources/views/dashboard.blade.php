<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-[#0a0a0a] flex items-center justify-center min-h-screen px-4">
<div class="bg-white dark:bg-[#161615] p-8 rounded shadow text-center w-full max-w-md">
    <h1 class="text-2xl font-semibold mb-6 dark:text-white">
        Welcome, {{ Auth::user()->name }}
    </h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">
            Logout
        </button>
    </form>
</div>
</body>
</html>

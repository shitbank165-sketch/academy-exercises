<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel Blog') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen bg-gray-50">
        <header class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between sm:px-6 lg:px-8">
                <div>
                    <a href="{{ route('posts.index') }}" class="text-lg font-semibold text-gray-900">Blog CRUD</a>
                </div>
                <div>
                    <a href="{{ route('posts.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Posts</a>
                    <a href="{{ route('posts.create') }}" class="ml-4 text-sm text-gray-600 hover:text-gray-900">Create Post</a>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>

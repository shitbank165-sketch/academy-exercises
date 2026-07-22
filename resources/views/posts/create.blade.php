@extends('layouts.app')

@section('content')
    <div class="max-w-3xl">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Create Post</h1>
                <p class="text-sm text-gray-600">Add a new post to your blog.</p>
            </div>
            <a href="{{ route('posts.index') }}" class="text-sm text-blue-600 hover:underline">Back to posts</a>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-black/5">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea name="content" rows="8" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Create</button>
                    <a href="{{ route('posts.index') }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

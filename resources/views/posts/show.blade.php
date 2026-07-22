@extends('layouts.app')

@section('content')
    <div class="max-w-3xl">
        <div class="mb-6 flex items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $post->title }}</h1>
                <p class="mt-2 text-sm text-gray-500">Published on {{ $post->created_at->format('F j, Y') }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('posts.edit', $post) }}" class="rounded-md border border-blue-600 px-3 py-2 text-sm text-blue-600 hover:bg-blue-50">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm text-white hover:bg-red-700" onclick="return confirm('Delete this post?')">Delete</button>
                </form>
            </div>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-black/5">
            <p class="whitespace-pre-line text-gray-700">{{ $post->content }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('posts.index') }}" class="text-sm text-blue-600 hover:underline">Back to posts</a>
        </div>
    </div>
@endsection

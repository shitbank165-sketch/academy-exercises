@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Posts</h1>
            <p class="text-sm text-gray-600">Manage your blog posts.</p>
        </div>
        <a href="{{ route('posts.create') }}" class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">New Post</a>
    </div>

    @if($posts->isEmpty())
        <div class="rounded-lg border border-dashed border-gray-300 bg-white p-8 text-center text-gray-700">
            No posts yet. Create a new post to get started.
        </div>
    @else
        <div class="space-y-4">
            @foreach($posts as $post)
                <div class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-black/5">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <a href="{{ route('posts.show', $post) }}" class="text-xl font-semibold text-gray-900 hover:text-blue-600">{{ $post->title }}</a>
                            <p class="mt-2 text-sm text-gray-600">{{ Str::limit($post->content, 180) }}</p>
                        </div>
                        <div class="text-right text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</div>
                    </div>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <a href="{{ route('posts.edit', $post) }}" class="rounded-md border border-blue-600 px-3 py-1 text-sm text-blue-600 hover:bg-blue-50">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-md bg-red-600 px-3 py-1 text-sm text-white hover:bg-red-700" onclick="return confirm('Delete this post?')">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @endif
@endsection

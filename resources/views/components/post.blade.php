@props(['post' => $post])

<div class="mb-4">

    {{-- User's Name --}}
    <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a>

    {{-- Date Posted --}}
    <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>

    {{-- Post Body --}}
    @if($post->body != strip_tags($post->body))
        <p class="mb-2">{!! $post->body !!}</p>
    @else
        <p class="mb-2">{{ $post->body }}</p>
    @endif

    {{-- Delete Post --}}
    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="mr-1">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-blue-500">Delete</button>
        </form>
    @endcan

    {{-- Like / Unlike --}}
    <div class="flex items-center">

        @auth
            {{-- Unlike --}}
            @if($post->likedBy(auth()->user()))
                <form action="{{ route('post.likes', $post) }}" method="POST" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500">Unlike</button>
                </form>
            {{-- Like --}}
            @else
                <form action="{{ route('post.likes', $post) }}" method="POST" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
            @endif

        @endauth

        {{-- Like Count --}}
        @if($post->likes->count() > 0)
            <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
        @endif

    </div>

</div>

@extends('layouts.app')

@section('content')

    <div class="flex justify-center">

        <div class="w-8/12 bg-white p-6 rounded-lg">

            {{-- Form --}}
            <form action="{{ route('posts') }}" method="POST" class="mb-4">

                @csrf

                {{-- Body --}}
                <div class="mb-4">

                    {{-- Label (Hidden) --}}
                    <label for="body" class="sr-only">Body</label>

                    {{-- Form Control --}}
                    <textarea
                        name="body" 
                        id="body"
                        cols="30"
                        rows="4"
                        class="bg-gray-100 border-2 w-full p-4 round-lg @error('body') border-red-500 @enderror"
                        placeholder="Post something..."
                    ></textarea>
                    
                    {{-- Error Message --}}
                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">
                        Post
                    </button>
                </div>

            </form>

            @if($posts->isEmpty())
                <p>No posts :(</p>
            @else

                {{-- Loop Through Posts --}}
                @foreach($posts as $post)
                    <div class="mb-4">

                        {{-- User's Name --}}
                        <a href="" class="font-bold">{{ $post->user->name }}</a>

                        {{-- Date Posted --}}
                        <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>

                        {{-- Post Body --}}
                        @if($post->body != strip_tags($post->body))
                            <p class="mb-2">{!! $post->body !!}</p>
                        @else
                            <p class="mb-2">{{ $post->body }}</p>
                        @endif

                        {{-- Like / Unlike --}}
                        @auth
                            <div class="flex items-center">

                                {{-- Unlike --}}
                                @if($post->likedBy(auth()->user()))
                                    <form action="{{ route('post.likes', $post->id) }}" method="POST" class="mr-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-blue-500">Unlike</button>
                                    </form>
                                {{-- Like --}}
                                @else
                                    <form action="{{ route('post.likes', $post->id) }}" method="POST" class="mr-1">
                                        @csrf
                                        <button type="submit" class="text-blue-500">Like</button>
                                    </form>
                                @endif

                                {{-- Like Count --}}
                                @if($post->likes->count() > 0)
                                    <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                                @endif

                            </div>
                        @endauth

                    </div>
                @endforeach

                {{-- Pagination Links --}}
                {{ $posts->links() }}

            @endif

        </div>

    </div>

@endsection

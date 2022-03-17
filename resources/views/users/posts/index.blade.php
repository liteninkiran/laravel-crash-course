@extends('layouts.app')

@section('content')

    <div class="flex justify-center">

        <div class="w-8/12">

            {{-- User's Name --}}
            <div class="p-6">
                <h1 class="text-2xl font-medium mb-3">{{ $user->name }}</h1>
                <p>{{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} | {{ $user->receivedLikes->count() }} {{ Str::plural('like', $user->receivedLikes->count()) }}</p>
            </div>

            @if(!$posts->isEmpty())
                <div class="bg-white p-6 rounded-lg">

                    {{-- Loop Through Posts --}}
                    @foreach($posts as $post)
                        <x-post :post="$post" />
                    @endforeach

                    {{-- Pagination Links --}}
                    {{ $posts->links() }}

                </div>
            @endif

        </div>

    </div>

@endsection

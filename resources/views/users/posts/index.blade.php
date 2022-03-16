@extends('layouts.app')

@section('content')

    <div class="flex justify-center">

        <div class="w-8/12 bg-white p-6 rounded-lg">
            <h1 class="text-lg font-bold mb-5">{{ $user->name }}</h1>

            @foreach($posts as $post)
                <p>{!! $post->body !!}</p>
                <hr class="mt-4 mb-4">
            @endforeach
        </div>

    </div>

@endsection

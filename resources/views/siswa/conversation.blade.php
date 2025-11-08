@extends('layouts.siswa')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-4">Conversation Videos</h2>

    @foreach($conversations as $conversation)
        <div class="bg-white p-4 rounded-lg shadow mb-4">
            <h3 class="text-lg font-medium mb-2">{{ $conversation->title }}</h3>
            <div class="aspect-w-16 aspect-h-9">
                <iframe class="w-full h-64"
                    src="{{ str_replace('watch?v=', 'embed/', $conversation->video) }}"
                    frameborder="0"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    @endforeach
</div>
@endsection

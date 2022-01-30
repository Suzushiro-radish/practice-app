<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$instrument->name}}
        </h2>
    </x-slot>

    <div class='posts'>
        <a class='create' href='/posts/create'>投稿</a>
        @foreach ($posts as $post)
            <div class='post'>
                <a class='title' href='/posts/{{ $post->id }}'> <h2> {{ $post->title }} </h2> </a>
                <a href='posts/instrument/{{ $post->instrument->id }}'>{{ $post->instrument->name }}</a>
                <p class='body'> {{ $post->body }} </p>
            </div>
            <br>
        @endforeach
        
        {{ $posts->links() }}
    </div>
    
</x-app-layout>


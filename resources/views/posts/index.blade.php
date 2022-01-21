<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿一覧
        </h2>
    </x-slot>

    <div class='posts'>
        <a class='create' href='/posts/create'>投稿</a>
        @foreach ($posts as $post)
            <div class='post'>
                <a class='title' href='/posts/{{ $post -> id }}'> <h2> {{ $post -> title }} </h2> </a>
                <a href="">{{ $post->instrument->name }}</a>
                <p class='body'> {{ $post -> body }} </p>
            </div>
            <br>
        @endforeach
        {{ $posts->links() }}
    </div>
    
</x-app-layout>


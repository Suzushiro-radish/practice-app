<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        ブックマークした練習方法
        </h2>
    </x-slot>

    <div class='posts'>
        <a class='create' href='/posts/create'>投稿</a>
        @foreach ($posts as $post)
            <div class='post'>
                <a class='title' href='/posts/{{ $post->id }}'> <h2>{{ $post->title }}</h2> </a>
                <a href='/posts/instruments/{{ $post->instrument->id }}'>{{ $post->instrument->name }}</a>
                <p class='body'> {{ $post->body }} </p>
                
                @foreach ($post->tags as $post_tag)
                    <p class='tag'>{{$post_tag->name}}</p>
                @endforeach
                        
                @if ($post->isBookmarked)
                    <form action='/posts/{{ $post->id }}/unbookmark' id="bookmark-form" method="post" style="display:inline">
                        @csrf
                        @method('POST')
                        <button type='submit' class='unbookmark' style='display:inline'> unBM </button>
                    </form>
                @else
                    <form action='/posts/{{ $post->id }}/bookmark' id="bookmark-form" method="post" style="display:inline">
                        @csrf
                        @method('POST')
                        <button type='submit' class='bookmark' style='display:inline'> BM </button>
                    </form>
                @endif
            </div>
            <br>
        @endforeach
        
    </div>
    
    {{$posts->appends(request()->query())->links()}}

</x-app-layout>
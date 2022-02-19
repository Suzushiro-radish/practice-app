<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post -> title }}
        </h2>
    </x-slot>

    <div class='post'>
        <a href="">{{ $post->instrument->name }}</a>
        <p class='body'> {{ $post -> body }} </p>
        <image class='image' src="{{$post->sources_url}}" title="画像" alt="画像">
        <div class='tags'>
            @foreach ($post->tags as $tag)
                <div class='tag'>
                    {{ $tag->name }},
                </div>
            @endforeach
        </div>
        <a class='edit' href='{{ $post -> id }}/edit' style='display:inline' > edit </a>
        {{--削除ボタン--}}
        <form action="/posts/{{ $post->id }}" id="form_delete" method="post" style="display:inline">
            @csrf
            @method('DELETE')
            <button type='submit' class='delete' style='display:inline' onclick='return deletePost(this)' > 削除 </button>
        </form>
        
        @if ($post->isBookmarked())
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
    
    <a href='/posts' class='back'> back </a>

    <script>
        function deletePost(e) {
            'use strict';
            if (confirm("削除すると復元できません。\n 本当に削除しますか？"))　{
                document.getElementByClass ('form_delete').submit();
            }
        }
    </script>
</x-app-layout>

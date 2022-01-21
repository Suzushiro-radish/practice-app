<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post -> title }}
        </h2>
    </x-slot>

    <div class='post'>
        <a href="">{{ $post->instrument->name }}</a>
        <p class='body'> {{ $post -> body }} </p>
        <a class='edit' href='{{ $post -> id }}/edit' style='display:inline' > edit </a>
        {{--削除ボタン--}}
        <form action="/posts/{{ $post->id }}" id="form_delete" method="post" style="display:inline">
            @csrf
            @method('DELETE')
            <button type='submit' class='delete' style='display:inline' onclick='return deletePost(this)' > 削除 </button>
        </form>
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

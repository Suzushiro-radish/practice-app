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
                    <a class='title' href='posts/{{ $post -> id }}'> <h2> {{ $post -> title }} </h2> </a>
                    <p class='body'> {{ $post -> body }} </p>
                    <a class='edit' href='posts/{{ $post -> id }}/edit' style='display:inline' > edit </a>
                    {{--削除ボタン--}}
                    <form action="/posts/{{ $post->id }}" id="form_delete" method="post" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type='submit' class='delete' style='display:inline' onclick='return deletePost(this)' > 削除 </button>
                    </form>
                </div>
            @endforeach
        </div>
        
        <script>
            function deletePost( e ) {
                'use strict';
                if (confirm("削除すると復元できません。\n 本当に削除しますか？"))　{
                    document.getElementByClass ('form_delete').submit();
                }
            }
        </script>
</x-app-layout>


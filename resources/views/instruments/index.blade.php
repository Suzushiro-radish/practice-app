<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$instrument->name}}
        </h2>
    </x-slot>
    
    <form action='/posts/instruments/{{$instrument->id}}/search' method='GET'>
        <select name='instrument'>
            @foreach ($instrument_list as $instrument_select)
                <option value={{ $instrument_select->id }}>{{ $instrument_select->name }}</option>
            @endforeach    
        </select>
        <input type='text' name='query' placeholder='Search'>
    </form>

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
            </div>
            <br>
        @endforeach
        
    </div>
    
    {{$posts->appends(request()->query())->links()}}

</x-app-layout>


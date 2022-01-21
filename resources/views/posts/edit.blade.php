<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post -> title }}(編集中)
        </h2>
    </x-slot>

    <form action='/posts/{{$post->id}}' method='POST' class='edit_form'>
        @csrf
        @method('PUT')
        <div class='title_form'>
            Title <br>
            <input type='text' name='post[title]' placeholder='タイトル' value="{{ $post -> title }}" />
            <div class='title_error' style='color:red'> {{ $errors -> first('post.title') }} </div>
        </div> 
        <br>
        <div class='instrument' >
            <select name="post[instrument_id]">
                @foreach($instruments as $instrument)
                    <option value={{ $instrument->id }}>{{ $instrument->name }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div class='body_form'>
            Body <br>
            <textarea name='post[body]'> {{ $post -> body }} </textarea>
            <div class='body_error' style='color:red'> {{ $errors -> first('post.body') }} </div>
        </div>
        <input type='submit' value='edit'>
    </form>
    
    <a href='/posts/{{ $post -> id }}' class='back'> back </a>
</x-app-layout>
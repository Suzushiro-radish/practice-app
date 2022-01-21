<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿作成
        </h2>
    </x-slot>

    <form action='/posts' method='POST' class='create_form'>
        @csrf
        <div class='title_form'>
            Title <br>
            <input type='text' name='post[title]' placeholder='タイトル' value="{{ old('post.title') }}" />
            <div class='title_error' style='color:red'> {{ $errors -> first('post.title') }} </div>
        </div> 
        <br>
        <div class='instrument_form'>
            楽器選択 <br>
            <select name="post[instrument_id]">
                <option value="1">ピアノ</option>
                <option value="2">ギター</option>
                <option value="3">バイオリン</option>
            </select>
            <div class='body_error' style='color:red'> {{ $errors -> first('post.instrument_id') }} </div>
        </div>
        <br>
        <div class='body_form'>
            Body <br>
            <textarea name='post[body]'> {{ old('post.body') }} </textarea>
            <div class='body_error' style='color:red'> {{ $errors -> first('post.body') }} </div>
        </div>
        <input type='submit' value='submit' />
    </form>
    
    <a href='/posts' class='back'> back </a>
</x-app-layout>
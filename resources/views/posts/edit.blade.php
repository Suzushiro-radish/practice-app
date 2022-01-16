<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <title>Blog</title>
    </head>
    
    <body>
        <h1>Blog Title</h1>
        
        <h2>編集ページ</h2>
        <form action="/posts/{{$post->id}}" method='POST' class='create_form'>
            @csrf
            @method('PUT')
            <div class='title_form'>
                Title <br>
                <input type='text' name='post[title]' placeholder='タイトル' value="{{ $post -> title }}" />
                <div class='title_error' style='color:red'> {{ $errors -> first('post.title') }} </div>
            </div> 
            <br>
            <div class='body_form'>
                Body <br>
                <textarea name='post[body]'> {{ $post -> body }} </textarea>
                <div class='body_error' style='color:red'> {{ $errors -> first('post.body') }} </div>
            </div>
            <input type='submit' value='edit' />
        </form>
        
        <a href='/' class='back'> back </a>

    </body>
</html>
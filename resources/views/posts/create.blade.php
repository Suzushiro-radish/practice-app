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
        
        <form action='/posts' method='POST' class='create_form'>
            @csrf
            <div class='title_form'>
                Title <br>
                <input type='text' name='post[title]' placeholder='タイトル' value="{{ old('post.title') }}" />
                <div class='title_error' style='color:red'> {{ $errors -> first('post.title') }} </div>
            </div> 
            <br>
            <div class='body_form'>
                Body <br>
                <textarea name='post[body]'> {{ old('post.body') }} </textarea>
                <div class='body_error' style='color:red'> {{ $errors -> first('post.body') }} </div>
            </div>
            <input type='submit' value='submit' />
        </form>
        
        <a href='/' class='back'> back </a>

    </body>
</html>

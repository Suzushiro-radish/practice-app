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
        <div class='post'>
            <h2>{{ $post -> title }}</h2>
            <p class='body'>{{ $post -> body }}</p>
        </div>
        <a href='/' class='back'> back </a>

    </body>
</html>


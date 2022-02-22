import React from 'react';
import ReactDOM from 'react-dom';

function Example() {
    return (
        <div class='posts'>
            <a class='create' href='/posts/create'>投稿</a>
            foreach $posts $post{
                
            }
                <div class='post'>
                    <a class='title' href='/posts/{{ $post->id }}'> <h2>{{ $post->title }}</h2> </a>
                    <a href='/posts/instruments/{{ $post->instrument->id }}'>{{ $post->instrument->name }}</a>
                    <p class='body'> {{ $post->body }} </p>
                    
                    {{ $post }}
                        <p class='tag'>{{$post_tag->name}}</p>
                    
                            
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
                <br>
            @endforeach
        </div>
        
    );
}

export default Example;

if (document.getElementById('app')) {
    ReactDOM.render(<Example />, document.getElementById('app'));
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Instrument;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        return view('posts/index')->with([ 'posts' => $post->getPaginateByLimit() ]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Instrument $instrument)
    {
        return view('posts/create', [ 'instruments' => $instrument->all() ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Post $post, Tag $tag)
    {
        $input = $request['post'];
        
        //タグがまだ存在していないとき
        if ( $tag->where( 'name', $input['tags'])->doesntExist() ) {
            //タグを新規登録
            $tag = Tag::create([
    	        'name' => $input['tags']
            ]);
	    };
        //データを登録
        $post = Post::create([
            'title' => $input['title'],
            'body' => $input['body'],
            'instrument_id' => $input['instrument_id'],
            'user_id' => Auth::id()
        ]);
        //タグとの中間テーブルに登録
        $post->tags()->attach($tag->where('name', $input['tags'])->value('id'));
        //投稿詳細画面へリダイレクト
	    return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts/show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Instrument $instruments)
    {
        return view('posts/edit', [ 'post' => $post, 'instruments' => $instruments->get() ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function update(PostRequest $request, Post $post, Tag $tag)
	{
	    $input = $request['post'];
	    if ( $tag->where( 'name', $input['tags'])->doesntExist() ) {
	        $tag->name = $input['tags'];
	        $tag->save();
	    };
	    
		$post->title = $input['title'];
		$post->body = $input['body'];
		$post->instrument_id = $input['instrument_id'];
		$post->tags = $input['tags'];
		$post->save();
		return redirect('/posts');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
		$post->delete();
    	return redirect('/posts');
    }
    
}

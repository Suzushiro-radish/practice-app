<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
    public function index(Post $post, Instrument $instrument)
    {
        // return view('posts/index')
        //     ->with([
        //         'is_bookmarked' => $post->isBookmarked(),
        //         'posts' => $post->getPaginateByLimit(), 
        //         'instruments' => $instrument->get(),
        //         'instrument_list' => Instrument::all(),
        //         ]);
        return Inertia::render('Posts/Index', [
                'posts' => Post::with(['instrument'])->get(), 
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Posts/Create', [ 'instruments' => Instrument::all() ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post, Tag $tag)
    {
        if( $request->file('file') ){
            try {
                $file = $request->file('file');
                $path = Storage::disk('s3')->putFile('/', $file, 'public');
                $file_path = Storage::disk('s3')->url($path);
            } catch(Exception $e){
                return $e;
            }
        } else {
            $file_path = null;
        }
        
        
        //データを登録
        $post = Post::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'instrument_id' => $request['instrument_id'],
            'user_id' => Auth::id(),
            'sources_url' => $file_path,
        ]);
        
        if($request['tags']){
            foreach ($request['tags'] as $input_tag){
                //タグがまだ存在していないとき
                if ( $input_tag!==null && $tag->where( 'name', $input_tag)->doesntExist() ) {
                    //タグを新規登録
                    $tag = Tag::create([
                        'name' => $input_tag
                    ]);
        	    } else {
        	    //タグが既に存在している時
                    //タグとの中間テーブルに登録
                    $post->tags()->attach($tag->where('name', $input_tag)->value('id'));
        	    }
            }
        }
        //投稿詳細画面へリダイレクト
	    return redirect('posts/'. $post->id );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return Inertia::render('Posts/Show', 
            [
                'post' => $post,
            ]);
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
            //タグを新規登録
            $tag = Tag::create([
    	        'name' => $input['tags']
            ]);
	    };
	    
		$post->title = $input['title'];
		$post->body = $input['body'];
		$post->instrument_id = $input['instrument_id'];
		$post->save();
		//タグとの中間テーブルに登録
		$post->tags()->attach($tag->where('name', $input['tags'])->value('id'));
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

<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Instrument;
use App\Models\Tag;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    
    /**
     * ブックマークを登録
     * 
     */
    public function store(Post $post)
    {
        //ブックマークを作成
        $bookmark = Bookmark::create([
                'post_id' => $post->id,
                'user_id' => Auth::id(),
            ]);
        
        //元のページへリダイレクト   
        return back();
    }
    
    /**
     * ブックマークを解除
     */
    public function destroy(Post $post)
    {
        $deleted = $post->bookmarks()->where('user_id', Auth::id())->delete();
        
        return back();
    }
    
    /**
     * ブックマーク一覧
     */
    public function index()
    {
        $post = Post::whereHas('bookmarks', function($query){
            $query->where('user_id', Auth::id());
        })->paginate(3);
        
        return view('posts.bookmark', ['posts' => $post]);
    }
    
    
}

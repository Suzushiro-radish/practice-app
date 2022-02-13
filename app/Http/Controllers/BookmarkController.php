<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        //ブックマークを作成
        $bookmark = Bookmark::create([
                'post_id' => $request['post_id'];
                'user_id' => Auth::id();
            ]);
        
        //元のページへリダイレクト   
        return back();
    }
    
    /**
     * ブックマークを解除
     */
    public function destroy(Request $request)
    {
        
    }
}

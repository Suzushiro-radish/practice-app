<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Instrument;
use App\Models\Tag;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Post $post, Instrument $instrument)
    {
        $query = $request['query'];
        $filtrated = $instrument->posts()->get();
        $searched = $filtrated->tags()->where('name', $input)->get();
        return view('posts.index', ['posts' => $searched]);
    }
}

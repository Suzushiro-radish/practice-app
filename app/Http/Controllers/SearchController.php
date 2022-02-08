<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Instrument;
use App\Models\Tag;

class SearchController extends Controller
{
    /**
     * タイトルと本文中を部分一致で検索
     * 
     */
    public function __invoke(Request $request, Post $post, Instrument $instrument)
    {
        $keywords = $request['query'];
        $query = Post::query();

        if ($keywords !== null){
            //全角スペースを半角スペースに変換
            $keywords = mb_convert_kana($keywords, 's');
            // キーワード文字列の前後のスペースを削除する
            $keywords = trim($keywords);
            // 取得したキーワードのスペースの重複を除く。
            $keywords = preg_replace('/\s(?=\s)/', '', $keywords);
            //半角スペースで分割
            $keyword_array = array_unique(explode(' ', $keywords));
            
            foreach ($keyword_array as $keyword){
            //キーワード毎に、楽器内でタイトルと本文を検索
                $query->orWhere('instrument_id', '=', $instrument->id)
                    ->where(function ($query) use ($keyword){
                        $query->where('title', 'like', "%$keyword%")
                            ->orWhere('body', 'like', "%$keyword%");
                    });
            }
            
            $searched = $query->get();
            dump($searched);
        }
        
        return view('instruments.index', 
            [
                'posts' => $searched, 
                'instrument'=>$instrument, 
                'instrument_list' => Instrument::all(),
            ]);
    }
    
}

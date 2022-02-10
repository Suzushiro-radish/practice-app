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
    public function __invoke(Request $request, Instrument $instrument)
    {
        $keywords = $request['query'];
        $instrument_id = $request['instrument'];
        
        //検索する楽器名
        if($instrument_id = 'all'){
            //instrumentがallなら、全ての楽器を代入
            $instrument_name = '全ての楽器'
        } elseif (is_int($instrument_id)){
            //$instrument_idに対応するinstrument_nameを取得
            $instrument_name = Instrument::where('id', $instrument_id)->value('name');
        }
        
        
        if ($request['tag_search'] === null) {
            $searched = self::titleBodySearch($keywords, $instrument_id);
        }
        
        if ($request['tag_search'] !== null) {
            $searched = self::tagSearch($keywords, $instrument_id);
        }
        
        return view('instruments.index', 
            [
                'posts' => $searched, 
                'instrument_id' => $instrument_id,
                'instrument_name' => $instrument_name, 
                'instrument_list' => Instrument::all(),
            ]);
    }
    
    private function titleBodySearch($keywords, $instrument_id)
    {
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
                $query->orWhere('instrument_id', '=', $instrument_id)
                    ->where(function ($query) use ($keyword){
                        $query->where('title', 'like', "%$keyword%")
                            ->orWhere('body', 'like', "%$keyword%");
                    });
            }
            
            $searched = $query->paginate(3);
        }
        
        return $searched;
    }
    
    private function tagSearch($keywords, $instrument_id)
    {
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
            //キーワード毎に、楽器内で$keywordのタグを持つ投稿を検索
                $query->orWhere('instrument_id', '=', $instrument_id)
                    ->whereHas('tags', function($query) use ($keyword){
                        $query->where('name', $keyword);
                    })
            }
            
            $searched = $query->paginate(3);
        }
        
        return $searched;
    }
}

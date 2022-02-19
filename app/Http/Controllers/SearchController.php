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
    public function __invoke(Request $request)
    {
        $keywords = $request['query'];
        $instrument_id = $request['instrument'];
        
        if( is_numeric($instrument_id) ) {
            $instrument_id = intval($instrument_id);
        }
        
        //検索する楽器名
        if($instrument_id == 'all'){
            //instrumentがallなら、全ての楽器を代入
            $instrument = null;
        } elseif (is_int($instrument_id)){
            //$instrument_idに対応するinstrument_nameを取得
            $instrument = Instrument::find($instrument_id);
        }
        
        //タグ検索とタイトル本文検索の分岐
        if ($request['tag_search'] === null) {
            //タイトルと本文を検索
            $searched = self::titleBodySearch($keywords, $instrument_id);
        } elseif ($request['tag_search'] !== null) {
            //タグを検索
            $searched = self::tagSearch($keywords, $instrument_id);
        }
        
        return view('posts.index', 
            [
                'posts' => $searched, 
                'instrument' => $instrument,
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
            
            if($keyword_array !== null && is_int($instrument_id) ){
            //$instrument_idに数字が入っていたら
                //キーワード毎に、楽器内でタイトルと本文を検索
                foreach ($keyword_array as $keyword){
                    $query->orWhere('instrument_id', '=', $instrument_id)
                        ->where(function ($query) use ($keyword){
                            $query->where('title', 'like', "%$keyword%")
                                ->orWhere('body', 'like', "%$keyword%");
                        });
                }
                $searched = $query->paginate(3);
                
            } elseif ($keyword_array!==null && $instrument_id==='all') {
            //instrument_idがallだったら
                ////キーワード毎に、すべての楽器でタイトルと本文を検索
                foreach ($keyword_array as $keyword){
                    $query->where(function ($query) use ($keyword){
                            $query->where('title', 'like', "%$keyword%")
                                ->orWhere('body', 'like', "%$keyword%");
                        });
                }
                $searched = $query->paginate(3);
            }
            
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
                    });
            }
            
            $searched = $query->paginate(3);
        }
        
        return $searched;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Instrument;

class InstrumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Instrument $instrument)
    {
        return view('posts.index', 
            [
                'instrument' => $instrument, 
                'instrument_list' => Instrument::all(),  
                'posts' => $instrument->getByInstrument(),
            ]);
    }

    public function posts(Instrument $instrument)
    {
        return view('posts.index', 
            [
                'instrument' => $instrument, 
                'instrument_list' => Instrument::all(),  
                'posts' => $instrument->getByInstrument(),
            ]);
    }

}

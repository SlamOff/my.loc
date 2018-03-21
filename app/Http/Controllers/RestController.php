<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Cymbals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

class RestController extends Controller
{

    public function getCymbals(Request $request)
    {
        $cymbals = [];
        $cymbals = Cymbals::select('id', 'image', 'price')->where('collection_id', $request->id)->orderBy('position', 'asc')->get()->toArray();
        return json_encode([
            'cymbals' => view('collections/_cymbals')->with(['cymbals' => array_chunk($cymbals,4),'active_page' => isset($request->page)?$request->page:1])->render(),
            'count' => count($cymbals)
        ]);
    }
}


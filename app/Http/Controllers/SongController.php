<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Song;

class SongController extends Controller
{
    public function song()
    {
        return view('song');
    }

    public function allSongs()
    {
        return response()->json(['songs' => Song::all()], 201);
    }
}

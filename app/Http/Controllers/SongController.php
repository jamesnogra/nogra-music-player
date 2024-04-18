<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Song;

class SongController extends Controller
{
    public function song()
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized.');
        }
        return view('song');
    }

    public function allSongs()
    {
        return response()->json(['songs' => Song::all()], 201);
    }
}

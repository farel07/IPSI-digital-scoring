<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matches;
use App\Models\User;
use App\Models\UserMatch;

class juriController extends Controller
{
    public function index($id)
    {
        $user_match = UserMatch::where('user_id', $id)->get();
        $user_match = $user_match->map(function ($match) {
            $match->match = Matches::find($match->match_id)->where('status', '!=', 'completed')->first();
            return $match;
        });

        // return $user_match[0]->match->playerMatches;
        // return User::find($id);

        return view("scoring.juri", [
            'id' => $id,
            'user_match' => $user_match[0],
        ]);
    }
}

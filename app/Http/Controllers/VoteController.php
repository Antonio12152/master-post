<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function vote(Request $request)
    {
        $data = $request->validate([
            'voteable_id' => 'required|integer',
            'voteable_type' => 'required|string',
            'vote' => 'required|in:1,-1'
        ]);

        $existing = Vote::where('user_id', Auth::id())
            ->where('voteable_id', $data['voteable_id'])
            ->where('voteable_type', $data['voteable_type'])
            ->first();

        if ($existing) {
            if ($existing->vote == $data['vote']) {
                $existing->delete();
                $newVote = 0;
            } else {
                $existing->update(['vote' => $data['vote']]);
                $newVote = $data['vote'];
            }
        } else {
            Vote::create([
                'user_id' => Auth::id(),
                'voteable_id' => $data['voteable_id'],
                'voteable_type' => $data['voteable_type'],
                'vote' => $data['vote']
            ]);
            $newVote = $data['vote'];
        }

        $score = \DB::table('votes')
            ->where('voteable_id', $data['voteable_id'])
            ->where('voteable_type', $data['voteable_type'])
            ->sum('vote');

        return response()->json([
            'score' => $score,
            'user_vote' => $newVote
        ]);
    }
}

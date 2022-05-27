<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Post;
use App\Models\Vote;
use App\Models\VotingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.index');
    }

    public function scan(Request $request) {
        $booth_id = Str::uuid()->toString();
        $voting_session_data = array(
            "booth" => $booth_id,
            "location" => "Kampala",
            "expires" => date("d-m-Y H:i:s",strtotime('+10 minutes'))
        );

        $voting_request = new VotingRequest([
            'booth_id' => $booth_id
        ]);
        $voting_request->save();

        $request->session()->put('booth', $booth_id);
        $request->session()->put('code', json_encode($voting_session_data));
        return view('home.scan');
    }

    public function vote(Request $request) {
        $posts = Post::all();
        $voting_request = VotingRequest::where('booth_id', $request->session()->get('booth'))->first();

        return view('home.vote', [
            'posts' => $posts,
            'voter_id' => $voting_request->voter_id
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function candidates($id)
    {
        $candidates = Candidate::where('post_id', '=', $id)->get();

        return response()->json($candidates);
    }

    public function cast(Request $request)
    {
        $request->validate([
            'post_id' => ['required', 'integer'],
            'candidate_id' => ['required', 'integer'],
            'voter_id' => ['required', 'integer', 'unique:votes,voter_id'],
        ], [
            'voter_id.unique' => 'You already cast your vote'
        ]);

        $vote = new Vote([
            'post_id' => $request->get('post_id'),
            'candidate_id' => $request->get('candidate_id'),
            'voter_id' => $request->get('voter_id'),
        ]);

        if ($vote->save()) {
            session()->forget('booth');
            session()->flash('message_success', 'Vote has been registered.');
        } else {
            session()->flash('message_fail', 'Vote has not been added.');
        }

        return redirect('/');
    }


}

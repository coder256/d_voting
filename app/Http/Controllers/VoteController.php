<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $votes = DB::table('votes')
            ->join('posts', 'posts.id', '=', 'votes.post_id')
            ->join('candidates', 'candidates.id', '=', 'votes.candidate_id')
            ->select('posts.name', 'candidates.first_name', 'candidates.last_name',
                'votes.id', 'votes.voter_id', 'votes.created_at')
            ->get();

        return view('votes.index', compact('votes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $posts = DB::table('posts')->get();

        return view('votes.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => ['required', 'integer'],
            'candidate_id' => ['required', 'integer'],
            'voter_id' => ['required', 'integer'],
        ]);

        $vote = new Vote([
            'post_id' => $request->get('post_id'),
            'candidate_id' => $request->get('candidate_id'),
            'voter_id' => $request->get('voter_id'),
        ]);

        if ($vote->save()) {
            session()->flash('message_success', 'Vote has been created.');
        } else {
            session()->flash('message_fail', 'Vote has not been added.');
        }

        return redirect('/vote');
    }

    /**
     * Display the specified resource.
     *
     * @param Vote $vote
     * @return Application|Factory|View|Response
     */
    public function show(Vote $vote)
    {
        return view('votes.show', compact('vote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Vote $vote
     * @return Application|Factory|View|Response
     */
    public function edit(Vote $vote)
    {
        return view('votes.edit', compact('vote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Vote $vote
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Vote $vote)
    {
        $request->validate([
            'post_id' => ['required', 'integer'],
            'candidate_id' => ['required', 'integer'],
            'voter_id' => ['required', 'integer'],
        ]);

        if ($vote->update($request->all())) {
            session()->flash('message_success', 'Vote updated successfully.');
        } else {
            session()->flash('message_fail', 'Vote not updated successfully.');
        }

        return redirect('/vote/' . $vote->id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Vote $vote
     * @return Application|RedirectResponse|Response|Redirector
     * @throws Exception
     */
    public function destroy(Vote $vote)
    {
        if ($vote->delete()) {
            session()->flash('message_success', 'Vote deleted successfully.');
        } else {
            session()->flash('message_fail', 'Vote not deleted successfully.');
        }

        return redirect('/vote');
    }
}

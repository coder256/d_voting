<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
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
use Illuminate\Support\Facades\Hash;

class CandidateController extends Controller
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
        $candidates = DB::table('candidates')
            ->join('posts', 'posts.id', '=', 'candidates.post_id')
            ->select('candidates.id', 'candidates.first_name', 'candidates.last_name', 'candidates.created_at', 'posts.name')
            ->get();

        return view('candidates.index', compact('candidates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $posts = DB::table('posts')->get();

        return view('candidates.create', compact('posts'));
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'post_id' => ['required', 'integer'],
        ]);

        $candidate = new Candidate([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'post_id' => $request->get('post_id'),
        ]);

        if ($candidate->save()) {
            session()->flash('message_success', 'Candidate has been created.');
        } else {
            session()->flash('message_fail', 'Candidate has not been added.');
        }

        return redirect('/candidate');
    }

    /**
     * Display the specified resource.
     *
     * @param Candidate $candidate
     * @return Application|Factory|View|Response
     */
    public function show(Candidate $candidate)
    {
        $candidate = DB::table('candidates')
            ->join('posts', 'posts.id', '=', 'candidates.post_id')
            ->select('candidates.id', 'candidates.first_name', 'candidates.last_name', 'candidates.created_at', 'posts.name')
            ->where('candidates.id', '=', $candidate->id)
            ->get();

        return view('candidates.show', compact('candidate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Candidate $candidate
     * @return Application|Factory|View|Response
     */
    public function edit(Candidate $candidate)
    {
        $posts = DB::table('posts')->get();

        $candidate = DB::table('candidates')
            ->join('posts', 'posts.id', '=', 'candidates.post_id')
            ->select('candidates.id', 'candidates.first_name', 'candidates.last_name',
                'candidates.created_at', 'candidates.post_id', 'posts.name')
            ->where('candidates.id', '=', $candidate->id)
            ->get();

        return view('candidates.edit', compact('candidate', 'posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Candidate $candidate
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'post_id' => ['required', 'integer'],
        ]);

        if ($candidate->update($request->all())) {
            session()->flash('message_success', 'Candidate updated successfully.');
        } else {
            session()->flash('message_fail', 'Candidate not updated successfully.');
        }

        return redirect('/candidate/' . $candidate->id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Candidate $candidate
     * @return Application|RedirectResponse|Response|Redirector
     * @throws Exception
     */
    public function destroy(Candidate $candidate)
    {
        if ($candidate->delete()) {
            session()->flash('message_success', 'Candidate deleted successfully.');
        } else {
            session()->flash('message_fail', 'Candidate not deleted successfully.');
        }

        return redirect('/candidate');
    }

    /**
     * Get resources by ID.
     *
     * @param $id
     * @return Application|\Illuminate\Http\JsonResponse|RedirectResponse|Response|Redirector
     */
    public function candidates($id)
    {
        $candidates = DB::table('candidates')
            ->where('post_id', '=', $id)
            ->get();

        return response()->json($candidates);
    }
}

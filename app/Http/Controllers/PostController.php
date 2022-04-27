<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
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
        $posts = DB::table('posts')->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('posts.create');
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
            'name' => ['required', 'string', 'max:255'],
        ]);

        $post = new Post([
            'name' => $request->get('name'),
        ]);

        if ($post->save()) {
            session()->flash('message_success', 'Post has been created.');
        } else {
            session()->flash('message_fail', 'Post has not been added.');
        }

        return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View|Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View|Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($post->update($request->all())) {
            session()->flash('message_success', 'Post updated successfully.');
        } else {
            session()->flash('message_fail', 'Post not updated successfully.');
        }

        return redirect('/post/' . $post->id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Application|RedirectResponse|Response|Redirector
     * @throws Exception
     */
    public function destroy(Post $post)
    {
        if ($post->delete()) {
            session()->flash('message_success', 'Post deleted successfully.');
        } else {
            session()->flash('message_fail', 'Post not deleted successfully.');
        }

        return redirect('/post');
    }
}

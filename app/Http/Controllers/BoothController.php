<?php

namespace App\Http\Controllers;

use App\Models\Booth;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BoothController extends Controller
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
        $booths = DB::table('booths')->get();

        return view('booths.index', compact('booths'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('booths.create');
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
            'supervisor' => ['required', 'string', 'max:255'],
            'latitude' => 'required|between:-90,90',
            'longitude' => 'required|between:-180,180'
        ]);

        $booth = new Booth([
            'name' => $request->get('name'),
            'supervisor' => $request->get('supervisor'),
            'latitude' => $request->get('latitude'),
            'longitude' => $request->get('longitude'),
        ]);

        if ($booth->save()) {
            session()->flash('message_success', 'Booth has been created.');
        } else {
            session()->flash('message_fail', 'Booth has not been added.');
        }

        return redirect('/booth');
    }

    /**
     * Display the specified resource.
     *
     * @param Booth $booth
     * @return Application|Factory|View|Response
     */
    public function show(Booth $booth)
    {
        return view('booths.show', compact('booth'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Booth $booth
     * @return Application|Factory|View|Response
     */
    public function edit(Booth $booth)
    {
        return view('booths.edit', compact('booth'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Booth $booth
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Booth $booth)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'supervisor' => ['required', 'string', 'max:255'],
            'latitude' => 'required|between:-90,90',
            'longitude' => 'required|between:-180,180'
        ]);

        if ($booth->update($request->all())) {
            session()->flash('message_success', 'Booth updated successfully.');
        } else {
            session()->flash('message_fail', 'Booth not updated successfully.');
        }

        return redirect('/booth/' . $booth->id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Booth $booth
     * @return Application|RedirectResponse|Response|Redirector
     * @throws Exception
     */
    public function destroy(Booth $booth)
    {
        if ($booth->delete()) {
            session()->flash('message_success', 'Booth deleted successfully.');
        } else {
            session()->flash('message_fail', 'Booth not deleted successfully.');
        }

        return redirect('/booth');
    }
}

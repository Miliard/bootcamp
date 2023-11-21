<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('chirps.index');
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([

            'message' => ['required', 'min:3', 'max:255']

        ]);

        $request->user()->chirps()->create($validated);



        return to_route('chirps.index')->with('status', 'Chirp creado sactifactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {

        $this->authorize('update', $chirp);

        //    if (auth()->user()->isNot($chirp->user)) {

        //     abort(403);
        // }

        // if (auth()->check() && auth()->user()->id !== $chirp->user_id) {
        //     abort(403);
        // }


        return view('chirps.edit', [
            'chirp' => $chirp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        //  if (auth()->check() && auth()->user()->id !== $chirp->user_id) {
        //     abort(403);
        // }

        $validated = $request->validate([

            'message' => ['required', 'min:3', 'max:255']

        ]);

        $chirp->update($validated);

        return to_route('chirps.index')->with('status', __('chirp updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}

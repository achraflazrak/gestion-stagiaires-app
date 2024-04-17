<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;

class OffreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $offres = Offre::all();
        return view('admin.dashboard.offres.index', compact('offres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.dashboard.offres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Offre::create($request->all());

        return redirect()->route('admin.offres')->with(['msg' =>'Offre ajouté avec succés']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $offre = Offre::findOrFail($id);

        return view('admin.dashboard.offres.show', compact('offre'));
    }

    public function publierOuCacher($id) {
        $offre = Offre::findOrFail($id);

        $offre->update([
            'is_published' => !$offre->is_published
        ]);

        return redirect()->route('admin.offres');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $offre = Offre::findOrFail($id);
        return view('admin.dashboard.offres.edit', compact('offre'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $offre = Offre::findOrFail($id);

        $offre->update($request->all());

        return redirect()->route('admin.offres')->with(['msg' =>'Offre modifié avec succés']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $offre = Offre::findOrFail($id);
        $offre->delete();

        return redirect()->route('admin.offres')->with(['msg' =>'Offre supprimé avec succés']);


    }

    public function showPublishedOffres()
    {
        $offres = Offre::all()->where('is_published', 1);
        return view('users.offres.show', compact('offres'));
    }
}

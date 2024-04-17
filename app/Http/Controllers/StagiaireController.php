<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StagiaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->is_admin) {
            $stgs = User::all()->where('is_admin', 0);
            return view('admin.dashboard.stagiaires.index', compact('stgs'));
        } else {
            $stg = auth()->user();
            return view('users.index', compact('stg'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stg = User::findOrFail($id);
        return view('admin.dashboard.stagiaires.show', compact('stg'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $stg = User::findOrFail($id);
        return view('users.edit', compact('stg'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, string $id)
    {
        $stg = User::findOrFail($id);

        $request->validate([
            'cv' => 'file|mimes:pdf,doc,docx|max:2048', // Validate the file
        ]);

        if ($request->hasFile('cv')) {
            // Delete old file, if necessary
            if ($stg->cv && Storage::disk('public')->exists('cvs/' . $stg->cv)) {
                Storage::disk('public')->delete('cvs/' . $stg->cv);
            }

            // Store new file and get the relative path
            $filePath = $request->file('cv')->store('cvs', 'public');
            $relativePath = 'storage/' . $filePath;  // Creates a path like "storage/cvs/filename.ext"

            // Update the model
            $stg->cv = $relativePath;  // Store the relative path in the database
        }

        // Update other attributes as needed
        $stg->fill($request->except('cv'));
        $stg->save();

        return redirect()->route('user.infos')->with([
            'msg' => 'Votre infos a été bien modifiées avec succès',
        ]);
    }


    public function destroy(string $id)
    {
        $stg = User::findOrFail($id);
        $stg->delete();

        return redirect()->route('admin.stgs')->with([
            'msg' => 'Stagiaire supprimé avec succés',
        ]);

    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StagiaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user() === null)
            return view('auth.login');

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


    public function create() {
        return view('admin.dashboard.stagiaires.create');
    }

    public function store(Request $request) {

        $request->validate([
            'cin' => ['required', 'string', 'max:255', 'unique:users,cin'],
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'dateN' => ['required', 'date', 'before:today'],
            'telephone' => ['required', 'string', 'digits:10'],
            'adresse' => ['required', 'string', 'max:1024'],
            'sexe' => ['required', 'in:m,f'],
            'etablissement' => ['required', 'string', 'max:255'],
            'filiere' => ['required', 'string', 'max:255'],
            'niveau' => ['required', 'string', 'in:bac+1,bac+2,bac+3,bac+4,bac+5'],
            // Pour le champ 'cv', une validation de fichier pourrait ressembler à ceci
            'cv' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:2048'], // Assurez-vous que le fichier ne dépasse pas 2MB et est de type pdf, doc ou docx
        ]);

        $cvPath = null;
        if (isset($request['cv'])) {
            $cvPath = $request['cv']->store('cvs');
        }

        User::create([
            'cin' => $request['cin'],
            'nom' => $request['nom'],
            'prenom' => $request['prenom'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'dateN' => $request['dateN'],
            'telephone' => $request['telephone'],
            'adresse' => $request['adresse'],
            'sexe' => $request['sexe'],
            'etablissement' => $request['etablissement'],
            'filiere' => $request['filiere'],
            'niveau' => $request['niveau'],
            'cv' => $cvPath, // Sauvegarde le chemin du fichier dans la base de données
        ]);

    return redirect()->route('admin.stgs')->with(['msg' => 'Le stagiaire a été bien enregistré']);

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        if (auth()->user() === null)
            return view('auth.login');

        $stg = User::findOrFail($id);
        if(auth()->user()->is_admin)
            return view('admin.dashboard.stagiaires.edit', compact('stg'));
        else
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
            $filePath = $request->file('cv')->store('cvs');

            // Update the model
            $stg->cv = $filePath;  // Store the relative path in the database
        }

        // Update other attributes as needed
        $stg->fill($request->except('cv'));
        $stg->save();

        if(auth()->user()->is_admin)
            return redirect()->route('admin.stgs')->with([
                'msg' => 'Les infos de stagaires a été bien modifiées avec succès',
            ]);
        else
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

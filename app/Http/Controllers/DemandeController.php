<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Offre;
use App\Models\Stage;
use App\Models\Demande;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        if ($user === null)
            return view('auth.login');

        if ($user->is_admin) {
            $demandes = Demande::all();
            return view('admin.dashboard.demandes.index', compact('demandes'));
        } else {
            $demandes = Demande::where('user_id', $user->id)->get();
            return view('users.demandes.index', compact('demandes'));
        }
    }

    public function accepter(string $id)
    {
        $demande = Demande::findOrFail($id);

        $demande->update([
            'is_accept' => 1
        ]);

        $stage = Stage::all()->where('user_id', $demande->user_id)->where('offre_id', $demande->offre_id)->first();

        if (!$stage) {
            Stage::create([
                'user_id' => $demande->user_id,
                'offre_id' => $demande->offre_id,
                'statut' => -1,
            ]);
        }

        return redirect()->route('admin.demandes');
    }

    public function refuser(string $id)
    {
        $demande = Demande::findOrFail($id);

        $demande->update([
            'is_accept' => 0
        ]);

        $stage = Stage::all()->where('user_id', $demande->user_id)->where('offre_id', $demande->offre_id)->first();
        if ($stage) {
            $stage->delete();
        }

        return redirect()->route('admin.demandes');
    }

    public function encours(string $id)
    {
        $demande = Demande::findOrFail($id);

        $demande->update([
            'is_accept' => null
        ]);

        $stage = Stage::all()->where('user_id', $demande->user_id)->where('offre_id', $demande->offre_id)->first();
        if ($stage) {
            $stage->delete();
        }
        return redirect()->route('admin.demandes');
    }


    public function downloadCV(string $id) {
        $demande = Demande::findOrFail($id);
        if ($demande->user->cv) {

            $filePath = storage_path('app/' .$demande->user->cv);

            if (File::exists($filePath)) {
                return response()->download($filePath, 'cv.pdf');

            } else {
                // Optional: Add an error message if the file doesn't exist
                return redirect()->route('admin.demandes')->with('error', 'File not found.');
            }
        } else {
            return redirect()->route('admin.demandes');
        }
    }

    public function downloadLM(string $id) {
        $demande = Demande::findOrFail($id);

        if ($demande->lettre_motivation) {
            // Ensure that the file path is relative to the storage/app directory
            $filePath = $demande->lettre_motivation;

            if (Storage::exists($filePath)) {
                // Use the storage_path() helper to get the absolute path
                $absolutePath = storage_path('app/' . $filePath);
                return response()->download($absolutePath, 'lettre-motivation.pdf');
            } else {
                // File does not exist in storage
                return redirect()->route('admin.demandes')->with('error', 'File not found.');
            }
        } else {
            // Lettre motivation is not set
            return redirect()->route('admin.demandes')->with('error', 'No motivation letter available.');
        }
    }


    public function createPDFCV($path) {
        // Ensure the provided path is safe
        $path = $path . '.pdf';

        // Path to your PDF file in the storage directory
        $pdfPath = storage_path('app/cvs/' . $path);

        // Check if the file exists
        if (File::exists($pdfPath)) {
            // Download the file
            return response()->download($pdfPath, null, [], 'inline');
        } else {
            // File not found, return a response indicating that
            return response()->json(['error' => 'PDF file not found'], 404);
        }
    }

    public function createPDFLM($path) {
        // Ensure the provided path is safe
        $path = $path . '.pdf';

        // Path to your PDF file in the storage directory
        $pdfPath = storage_path('app/lms/' . $path);

        // Check if the file exists
        if (File::exists($pdfPath)) {
            // Download the file
            return response()->download($pdfPath, null, [], 'inline');
        } else {
            // File not found, return a response indicating that
            return response()->json(['error' => 'PDF file not found'], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $offreId = null)
    {
        if ($offreId !== null) {
            return view('users.demandes.create', compact('offreId'));
        } else {
            $offres = Offre::all();
            return view('users.demandes.create', compact('offres', 'offreId'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $offreId = null)
    {
         $request->validate([
                'lettre_motivation' => 'required|file|mimes:pdf|max:5120', // 5MB max size
            ]);

        $filePath = '';
        if ($request->hasFile('lettre_motivation')) {
            $file = $request->file('lettre_motivation');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $filePath = $file->storeAs('lms', $fileName);
        }

        if ($offreId !== null) {
            if (Demande::where('offre_id', $offreId)->where('user_id', auth()->user()->id)->first() === null) {
                Demande::create([
                    'lettre_motivation' => $filePath,
                    'user_id' => Auth::user()->id,
                    'offre_id' => $offreId
                ]);

                return redirect()->route('user.demandes')->with([
                    'msg' => 'Votre demande a été bien enregistrer',
                ]);
            } else {
                return redirect()->route('user.demandes')->with([
                    'msgErr' => 'Offre est déja demandée'
                ]);
            }
        } else {

            if (Demande::where('offre_id', $request->offre_id)->where('user_id', auth()->user()->id)->first() === null) {
                Demande::create([
                    'lettre_motivation' => $filePath,
                    'user_id' => Auth::user()->id,
                    'offre_id' => $request->offre_id
                ]);

                return redirect()->route('user.demandes')->with([
                    'msg' => 'Votre demande a été bien enregistrer',
                ]);
            } else {
                return redirect()->route('user.demandes')->with([
                    'msgErr' => 'Offre est déja demandée'
                ]);
            }

        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Demande $demande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $demande = Demande::findOrFail($id);
        $offres = Offre::where('is_published', 1)->get();
        return view('users.demandes.edit', compact(['demande', 'offres']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $demande = Demande::find($id);

            $request->validate([
                'lettre_motivation' => 'file|mimes:pdf,doc,docx|max:2048', // Adjust validation as needed
            ]);

            if ($request->hasFile('lettre_motivation')) {
                // Delete old file, if necessary
                if ($demande->lettre_motivation && Storage::exists('app/lms'.$demande->lettre_motivation)) {
                    Storage::delete($demande->lettre_motivation);
                }

                // Store new file
                $filePath = $request->file('lettre_motivation')->store('lms/', 'local');
                $demande->lettre_motivation = $filePath;
            }

            $demande->offre_id = $request->offre_id;
            $demande->user_id = auth()->user()->id;

            $demande->save();

            return redirect()->route('user.demandes')->with('msg', 'Lettre de Motivation a été modifiée avec succés!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $offreId = null)
    {
        //
        if ($offreId === null && $id != -1) {
            $demande = Demande::findOrFail($id);
        } else {
            $demande = Demande::where('user_id', Auth::user()->id)->where('offre_id', $offreId)->first();
        }

        $demande->delete();


        return redirect()->back()->with([
            'msg' => 'Demende supprimée avec succés'
        ]);
    }
}

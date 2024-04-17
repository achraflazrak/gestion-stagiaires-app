<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->is_admin) {
            $stages = Stage::all();
            return view('admin.dashboard.stages.index', compact('stages'));
        } else {
            $stages = Stage::where('user_id', auth()->user()->id)->get();
            return view('users.stages.index', compact('stages'));
        }
    }

    public function downloadAttestation(string $id) {
        $stage = Stage::findOrFail($id);
        if ($stage->statut == 1) {
            $stg = $stage->user;
            $view = view('admin.dashboard.stages.documents.attestation', compact('stg')); // Prepare the view
            $pdf = PDF::loadHTML($view->render())->setPaper('a4', 'landscape'); // Convert to PDF

            return $pdf->download('attestation-stage.pdf'); // Download the PDF
        } else {
            return redirect()->route('admin.stages');
        }
    }


public function downloadFC(string $id) {
    $stage = Stage::findOrFail($id);

    if ($stage->fiche_confirmation) {

        $filePath = storage_path('app/' .$stage->fiche_confirmation);

        if (File::exists($filePath)) {
            return response()->download($filePath, 'fiche-confirmation.pdf');

        } else {
            // Optional: Add an error message if the file doesn't exist
            return redirect()->route('admin.stages')->with('error', 'File not found.');
        }
    } else {
        return redirect()->route('admin.stages');
    }
}

    public function downloadFE(string $id) {
        $stage = Stage::findOrFail($id);

        if ($stage->fiche_evaluation) {

            $filePath = storage_path('app/' .$stage->fiche_evaluation);

            if (File::exists($filePath)) {
                return response()->download($filePath, 'fiche-evaluation.pdf');
            } else {
                // Optional: Add an error message if the file doesn't exist
                return redirect()->route('admin.stages')->with('error', 'File not found.');
            }
        } else {
            return redirect()->route('admin.stages');
        }
    }

    public function downloadRapport(string $id) {
        $stage = Stage::findOrFail($id);

        if ($stage->rapport) {

            $filePath = storage_path('app/' .$stage->rapport);

            if (File::exists($filePath)) {
                return response()->download($filePath, 'rapport-stage.pdf');
            } else {
                // Optional: Add an error message if the file doesn't exist
                return redirect()->route('admin.stages')->with('error', 'File not found.');
            }
        } else {
            return redirect()->route('admin.stages');
        }
    }



public function createPDFFC($path) {
    // Append '.pdf' suffix to ensure the filename ends with '.pdf'
    $fileName = $path . '.pdf';

    // Construct the storage path relative to the configured 'local' disk's root ('storage/app')
    $storagePath = 'fcs/' . $fileName;  // Assuming files are stored in 'storage/app/fcs'

    // Use Laravel's Storage facade to check if the file exists and to get the absolute path
    if (Storage::disk('local')->exists($storagePath)) {
        // Get the absolute path to the file
        $absolutePath = storage_path('app/' . $storagePath);

        // Download the file, displayed inline
        return response()->download($absolutePath, null, [], 'inline');
    } else {
        // File not found, return a response indicating that
        return response()->json(['error' => 'PDF file not found'], 404);
    }
}

    public function createPDFFE($path) {
        // Append '.pdf' suffix to ensure the filename ends with '.pdf'
        $fileName = $path . '.pdf';

        // Construct the storage path relative to the configured 'local' disk's root ('storage/app')
        $storagePath = 'fes/' . $fileName;  // Assuming files are stored in 'storage/app/fcs'

        // Use Laravel's Storage facade to check if the file exists and to get the absolute path
        if (Storage::disk('local')->exists($storagePath)) {
            // Get the absolute path to the file
            $absolutePath = storage_path('app/' . $storagePath);

            // Download the file, displayed inline
            return response()->download($absolutePath, null, [], 'inline');
        } else {
            // File not found, return a response indicating that
            return response()->json(['error' => 'PDF file not found'], 404);
        }
    }


    public function updateFC(Request $request, string $id)
    {
        $stage = Stage::findOrFail($id);  // Use findOrFail to handle the case where the stage does not exist

        $request->validate([
            'fiche_confirmation' => 'file|mimes:pdf,doc,docx|max:2048', // .Validation rules are correct
        ]);


        if ($request->hasFile('fiche_confirmation')) {
            // Delete old file, if necessary
            if ($stage->fiche_confirmation && Storage::disk('public')->exists('fcs/' . $stage->fiche_confirmation)) {
                Storage::disk('public')->delete('fcs/' . $stage->fiche_confirmation);
            }

            // Store new file
            $filePath = $request->file('fiche_confirmation')->store('fcs', 'local');
            // Store only the relative path in the database
            $stage->fiche_confirmation = $filePath;
            $stage->save(); // Make sure to save the update to the model
        }

        return redirect()->route('user.stages')->with('msg', 'Fiche de confirmation a été modifiée avec succès!');
    }


    public function updateFE(Request $request, string $id)
    {
        $stage = Stage::find($id);

        $request->validate([
            'fiche_evaluation' => 'file|mimes:pdf,doc,docx|max:2048', // Adjust validation as needed
        ]);

        if ($request->hasFile('fiche_evaluation')) {
            // Delete old file, if necessary
            if ($stage->fiche_evaluation && Storage::exists('app/fes' . $stage->fiche_evaluation)) {
                Storage::delete($stage->fiche_evaluation);
            }

            // Store new file
            $filePath = $request->file('fiche_evaluation')->store('fes', 'local');
        }

        $stage->update([
            'fiche_evaluation' => $filePath
        ]);

         return redirect()->route('user.stages')->with('msg', 'Fiche de evaluation a été modifiée avec succés!');
    }


    public function updateRapport(Request $request, string $id)
    {
        $stage = Stage::find($id);

        $request->validate([
            'rapport' => 'file|mimes:pdf,doc,docx|max:2048', // Adjust validation as needed
        ]);

        if ($request->hasFile('rapport')) {
            // Delete old file, if necessary
            if ($stage->rapport && Storage::exists('app/raps' . $stage->rapport)) {
                Storage::delete($stage->rapport);
            }

            // Store new file
            $filePath = $request->file('rapport')->store('raps', 'local');
        }

        $stage->update([
            'rapport' => $filePath
        ]);

         return redirect()->route('user.stages')->with('msg', 'Rapport de stage a été modifiée avec succés!');
    }


    public function createPDFRapport($path) {
        // Append '.pdf' suffix to ensure the filename ends with '.pdf'
        $fileName = $path . '.pdf';

        // Construct the storage path relative to the configured 'local' disk's root ('storage/app')
        $storagePath = 'raps/' . $fileName;  // Assuming files are stored in 'storage/app/fcs'

        // Use Laravel's Storage facade to check if the file exists and to get the absolute path
        if (Storage::disk('local')->exists($storagePath)) {
            // Get the absolute path to the file
            $absolutePath = storage_path('app/' . $storagePath);

            // Download the file, displayed inline
            return response()->download($absolutePath, null, [], 'inline');
        } else {
            // File not found, return a response indicating that
            return response()->json(['error' => 'PDF file not found'], 404);
        }
    }


    public function deleteFC(Request $request, string $id)
    {
        $stage = Stage::findOrFail($id);  // Use findOrFail to handle the case where the stage does not exist

            // Delete old file, if necessary
        if ($stage->fiche_confirmation && Storage::disk('public')->exists('fcs/' . $stage->fiche_confirmation)) {
            Storage::disk('public')->delete('fcs/' . $stage->fiche_confirmation);
        }

            // Store only the relative path in the database
        $stage->fiche_confirmation = null;
        $stage->save();

        return redirect()->route('user.stages')->with('msg', 'Fiche de confirmation a été supprimée avec succès!');
    }


    public function deleteFE(Request $request, string $id)
    {
        $stage = Stage::find($id);

        if ($stage->fiche_evaluation && Storage::exists('app/fes' . $stage->fiche_evaluation)) {
            Storage::delete($stage->fiche_evaluation);
        }

        $stage->update([
            'fiche_evaluation' => null
        ]);

         return redirect()->route('user.stages')->with('msg', 'Fiche de evaluation a été supprimée avec succés!');
    }


    public function deleteRapport(Request $request, string $id)
    {
        $stage = Stage::find($id);

        if ($stage->rapport && Storage::exists('app/raps' . $stage->rapport)) {
            Storage::delete($stage->rapport);
        }


        $stage->update([
            'rapport' => null
        ]);

         return redirect()->route('user.stages')->with('msg', 'Rapport de stage a été supprimé avec succés!');
    }

    public function prestage(string $id)
    {
        $stage = Stage::findOrFail($id);

        $stage->update([
            'statut' => -1
        ]);

        return redirect()->route('admin.stages');
    }

    public function encoursStage(string $id)
    {
        $stage = Stage::findOrFail($id);

        $stage->update([
            'statut' => 0
        ]);

        return redirect()->route('admin.stages');
    }


    public function finStage(string $id)
    {
        $stage = Stage::findOrFail($id);

        $stage->update([
            'statut' => 1
        ]);

        return redirect()->route('admin.stages');
    }

   public function annulerStage(string $id)
    {
        $stage = Stage::findOrFail($id);

        $stage->update([
            'statut' => -2
        ]);

        return redirect()->route('admin.stages');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Stage $stage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stage $stage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stage $stage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $stage = Stage::findOrFail($id);
        $stage->delete();
        if(auth()->user()->is_admin) {
            return redirect()->route('admin.stages');
        } else {
            return redirect()->route('user.stages');
        }
    }
}

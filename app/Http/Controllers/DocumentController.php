<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offre;
use App\Models\Stage;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $stgs = User::all()->where('is_admin', 0);
        $offres = Offre::all();

        return view('admin.dashboard.documents.index', compact(['stgs', 'offres']));
    }


    public function downloadCV(string $id)
    {
        $demande = Demande::findOrFail($id);

        if ($demande->user->cv) {

            $filePath = storage_path('app/' . $demande->user->cv);

            if (File::exists($filePath)) {
                return response()->download($filePath, 'cv.pdf');

            } else {
                // Optional: Add an error message if the file doesn't exist
                return redirect()->route('admin.documents')->with('error', 'File not found.');
            }
        } else {
            return redirect()->route('admin.documents');
        }
    }

    public function downloadLM(string $id)
    {
        $demande = Demande::findOrFail($id);

        if ($demande->lettre_motivation) {

            $filePath = storage_path('app/' . $demande->lettre_motivation);

            if (File::exists($filePath)) {
                return response()->download($filePath, 'lettre-motivation.pdf');

            } else {
                // Optional: Add an error message if the file doesn't exist
                return redirect()->route('admin.documents')->with('error', 'File not found.');
            }
        } else {
            return redirect()->route('admin.documents');
        }
    }

    public function createPDFCV($path)
    {
        // Ensure the provided path is safe
        $path = $path . '.pdf';

        // Path to your PDF file in the storage directory
        $pdfPath = storage_path('app/storage/cvs/' . $path);

        // Check if the file exists
        if (File::exists($pdfPath)) {
            // Download the file
            return response()->download($pdfPath, null, [], 'inline');
        } else {
            // File not found, return a response indicating that
            return response()->json(['error' => 'PDF file not found'], 404);
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

}

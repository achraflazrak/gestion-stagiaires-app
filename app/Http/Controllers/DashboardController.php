<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stage;
use App\Models\Demande;
use App\Models\Offre;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index() {
        if (auth()->user() === null)
            return view('auth.login');

        $nbDemandes = Demande::all()->count();
        $nbDemandesAcceptees = Demande::all()->where('is_accept', true)->count();
        $nbDemandesRefusees = Demande::all()->where('is_accept','===', false)->count();
        $nbDemandesAttendes = Demande::all()->where('is_accept','===', null)->count();

        $nbStages = Stage::all()->count();
        $nbStagesEnCours = Stage::all()->where('statut', 0)->count();
        $nbStagesTermines = Stage::all()->where('statut', 1)->count();

        $nbOffres = Offre::all()->count();
        $nbOffresPubliees = Offre::where('is_published', 1)->count();


        $nbStgs = User::all()->where('is_admin', 0)->count();


        return view('admin.home', compact([
            'nbDemandes', 'nbDemandesAcceptees', 'nbDemandesRefusees', 'nbStages', 'nbStgs',
            'nbDemandesAttendes', 'nbStagesEnCours', 'nbStagesTermines', 'nbOffres', 'nbOffresPubliees'
        ]));
    }
}

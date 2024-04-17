<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'offre_id', 'statut', 'fiche_confirmation', 'fiche_evaluation', 'rapport', 'attestation'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function offre() {
        return $this->belongsTo(Offre::class);
    }



}

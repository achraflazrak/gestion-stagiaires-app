<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_accept', 'user_id', 'offre_id', 'lettre_motivation'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function offre() {
        return $this->belongsTo(Offre::class);
    }


    public function getStageByDemandeId($demandeId) {
        $demande = Demande::findOrFail($demandeId);
        return Stage::where('offre_id', $demande->offre_id)->where('user_id', $demande->user_id)->first();
    }

}

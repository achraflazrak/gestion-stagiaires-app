<?php

namespace App\Models;

use App\Models\Stage;
use App\Models\Demande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offre extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'sujet', 'profil_requis', 'duree', 'date_debut' ,'lieu', 'description', 'is_published'];

    public function demandes() {
        return $this->hasMany(Demande::class);
    }

    public function stages() {
        return $this->hasMany(Stage::class);
    }

    public function findStageByStgAndOffre($stg, $offre) {
        return Stage::where('user_id', $stg->id)->where('offre_id', $offre->id)->first();
    }

    public function findDemandeByStgAndOffre($stg) {
        return Demande::where('user_id', $stg->id)->where('offre_id', $this->id)->first();
    }

}

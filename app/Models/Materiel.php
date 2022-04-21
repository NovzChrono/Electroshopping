<?php

namespace App\Models;

use App\Models\Taux;
use App\Models\Marque;
use App\Models\Vendeur;
use App\Models\Categorie_materiel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materiel extends Model
{
    use HasFactory;

    protected $table= 'materiels';
    protected $fillable = [
        'id',
        'nom_mat',
        'tag',
        'marque_id',
        'vendeur_id',
        'description_mat',
        'gdescription_mat',
        'prixnormal_mat',
        'prixreduit_mat',
        'qte_mat',
        'impot_mat',
        'statut_mat',
        'popular_mat',
        'image_mat',
        'image2_mat',
        'image3_mat',
        'categorie_materiel_id'
    ];
    public function categorie_materiel()
    {
        return $this->belongsTo(Categorie_materiel::class,'categorie_materiel_id','id');
    }
    public function vendeur()
    {
        return $this->belongsTo(Vendeur::class,'vendeur_id','id');
    }
    public function marque()
    {
        return $this->belongsTo(Marque::class,'marque_id','id');
    }
    public function taux()
    {
        return $this->hasMany(Taux::class);
    }
}

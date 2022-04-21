<?php

namespace App\Models;

use App\Models\Materiel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie_materiel extends Model
{
    use HasFactory;

    public function materiels()
    {
        return $this->hasMany(Materiel::class);
    }
    protected $table= 'categorie_materiels';
    protected $fillable = ['libelleCatMat','descriptionCatMat','imageCatMat','statutCatMat','popularCatMat'];

}

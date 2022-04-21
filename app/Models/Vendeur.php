<?php

namespace App\Models;

use App\Models\Materiel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendeur extends Model
{
    use HasFactory;
    protected $table = 'vendeurs';
    protected $fillable = [
        'id',
        'nom',
        'pnoms',
        'tel',
        'adrss'
    ];

    public function materiels()
    {
        return $this->hasMany(Materiel::class);
    }
}

<?php

namespace App\Models;

use App\Models\Materiel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Marque extends Model
{
    use HasFactory;
    protected $table = 'marques';
    protected $fillable = [
        'id',
        'nom',
        'logo'
    ];

    public function materiels()
    {
        return $this->hasMany(Materiel::class);
    }
}

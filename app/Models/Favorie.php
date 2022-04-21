<?php

namespace App\Models;

use App\Models\Materiel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorie extends Model
{
    use HasFactory;
     protected $table = 'favories';
    protected $fillable = [
        'user_id',
        'materiel_id',
        'qte_mat'
    ];

    public function materiels()
    {
        return $this->belongsTo(Materiel::class,'materiel_id','id');
    }
}

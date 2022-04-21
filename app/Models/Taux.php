<?php

namespace App\Models;

use App\Models\User;
use App\Models\Materiel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Taux extends Model
{
    use HasFactory;

    protected $table = 'tauxes';
    protected $fillable = [
        'id',
        'user_id',
        'materiel_id',
        'note',
        'commentaire'
    ];
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function materiel()
    {
        return $this->belongsTo(Materiel::class,'materiel_id','id');
    }
}

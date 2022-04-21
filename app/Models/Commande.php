<?php

namespace App\Models;

use App\Models\User;
use App\Models\Item_cmd;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;
    protected $table = 'commandes';
    protected $fillable = [
        'id',
        'user_id',
        'nom',
        'pnom',
        'email',
        'tel',
        'adrss1',
        'adrss2',
        'ville',
        'quartier',
        'total',
        'codepin',
        'statut',
        'message',
        'suivie_nb',
        'date',
        'domicile'
    ];
    public function itemcmds()
    {
        return $this->hasMany(Item_cmd::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}

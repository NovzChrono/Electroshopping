<?php

namespace App\Models;

use App\Models\Commande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item_cmd extends Model
{
    use HasFactory;
    protected $table = 'item_cmds';
    protected $fillable = [
        'id',
        'cmd_id',
        'mat_id',
        'qte',
        'total',
    ];
    /**
     * Obtenir les materiels qui possède les itemcmd
     *
     * @return BelongsTo
     */
    public function materiels() : BelongsTo
    {
        return $this->belongsTo(Materiel::class,'mat_id','id');
    }
    public function commande()
    {
        return $this->belongsTo(Commande::class,'cmd_id','id');
    }
}

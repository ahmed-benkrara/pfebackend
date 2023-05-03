<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Modele;

class ModelImage extends Model
{
    use HasFactory;
    protected $table = 'modelimage';
    protected $primarykey = 'id';
    protected $fillable = [
        'url', 'isposter', 'modele_id'
    ];

    public function modele(){
        return $this->belongsTo(Modele::class);
    }
}

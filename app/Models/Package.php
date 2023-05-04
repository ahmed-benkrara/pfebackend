<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Modele;

class Package extends Model
{
    use HasFactory;
    protected $table = 'package';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'description', 'price'
    ];

    public function models(){
        return $this->hasMany(Modele::class);
    }
}

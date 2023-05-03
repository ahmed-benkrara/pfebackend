<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;
use App\Models\ModelImage;

class Modele extends Model
{
    use HasFactory;
    protected $table = 'modele';
    protected $primarykey = 'id';
    protected $fillable = [
        'name', 'description', 'price', 'package_id'
    ];

    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function images(){
        return $this->hasMany(ModelImage::class);
    }
}

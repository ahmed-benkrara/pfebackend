<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Modele;
use App\Models\Package;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'orderitem';
    protected $primarykey = 'id';
    protected $fillable = [
        'order_id', 'modele_id', 'package_id', 'quantity', 'type'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function package(){
        return $this->hasOne(Package::class);
    }

    public function modele(){
        return $this->hasOne(Modele::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_name', 
    'product_quantity', 'product_price',
     'total_price', 'is_paid', 'is_shipped'];

     public function users()
    {
        return $this->belongsTo(User::class);
    }
   
}

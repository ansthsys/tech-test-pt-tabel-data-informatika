<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name', 
        'order_date',
        'total_price',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

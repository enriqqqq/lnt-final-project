<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'invoice';
    protected $keyType = 'string';

    protected $fillable = [
        'invoice',
        'user_id',
        'item_id',
        'amount',
        'address',
        'postal_code',
        'total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}

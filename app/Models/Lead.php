<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
     use HasFactory;

    protected $fillable = [
        'customer', 'product_id', 'status_id', 'source',
        'number', 'followup_date', 'next_action', 'call_status'
    ];

    public function status()
{
    return $this->belongsTo(Status::class);
}
public function product()
{
    return $this->belongsTo(\App\Models\Product::class);
}

}

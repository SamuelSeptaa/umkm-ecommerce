<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function transaction_detail()
    {
        return $this->hasMany(transaction_detail::class);
    }

    public function shop()
    {
        return $this->belongsTo(shop::class);
    }
}

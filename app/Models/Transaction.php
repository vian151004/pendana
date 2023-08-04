<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'donation_id', 'reference', 'merchant_ref', 'total_amount', 'status'];

    function user() {
        return $this->belongsTo(User::class);
    }

    function donation() {
        return $this->belongsTo(Donation::class);
    }
}

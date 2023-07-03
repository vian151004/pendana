<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cashout extends Model
{
    use HasFactory;

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    function scopeDonatur($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function statusText()
    {
        $color = '';

        switch ($this->status) {
            case 'success':
                $color = 'dikonfirmasi';
                break;
            case 'pending':
                $color = 'belum dikonfirmasi';
                break;
            case 'canceled':
                $color = 'dibatalkan';
                break;
            case 'rejected':
                $color = 'ditolak';
                break;
            default:
                break;
        }

        return $color;
    }

    public function statusColor()
    {
        $color = '';

        switch ($this->status) {
            case 'success':
                $color = 'success';
                break;
            case 'pending':
                $color = 'dark';
                break;
            case 'canceled':
                $color = 'danger';
                break;
            case 'rejected':
                $color = 'secondary';
                break;
            default:
                break;
        }

        return $color;
    }
}

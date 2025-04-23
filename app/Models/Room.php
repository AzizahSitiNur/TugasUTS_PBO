<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'capacity',
        'facilities',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isAvailable($start_time, $end_time, $exclude_booking_id = null)
    {
        $query = $this->bookings()
            ->where('status', 'approved')
            ->where(function ($query) use ($start_time, $end_time) {
                $query->whereBetween('start_time', [$start_time, $end_time])
                    ->orWhereBetween('end_time', [$start_time, $end_time])
                    ->orWhere(function ($query) use ($start_time, $end_time) {
                        $query->where('start_time', '<=', $start_time)
                            ->where('end_time', '>=', $end_time);
                    });
            });

        if ($exclude_booking_id) {
            $query->where('id', '!=', $exclude_booking_id);
        }

        return !$query->exists();
    }
}

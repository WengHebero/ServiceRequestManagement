<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_reference',
        'resident_id',
        'tradie_id',
        'service_id',
        'booking_date',
        'booking_session',
        'status'
    ];

    public static function generateBookingReference()
    {
        $latestRequest = self::latest()->first();
        $referenceNumber = $latestRequest ? intval(substr($latestRequest->booking_reference, 2)) + 1 : 1000;
        return 'BK' . str_pad($referenceNumber, 4, '0', STR_PAD_LEFT);
    }
}

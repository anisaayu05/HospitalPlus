<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    use HasFactory;

    /**
     * Kolom-kolom yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id',
        'diagnosis',
        'treatment',
    ];

    /**
     * Relasi ke model Patient.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}

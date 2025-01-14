<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    use HasFactory;

    /**
     * Kolom-kolom yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id',
        'medical_history',
        'lab_results',
        'vaccination',
    ];

    /**
     * Relasi ke model Patient.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Kolom-kolom yang dapat diisi (mass assignable).
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];
}

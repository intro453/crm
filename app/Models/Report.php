<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'period_start',
        'period_end',
        'total_applications',
        'completed_applications',
        'total_revenue',
        'summary',
    ];

    protected $casts = [
        'period_start' => 'date',
        'period_end' => 'date',
        'total_applications' => 'integer',
        'completed_applications' => 'integer',
        'total_revenue' => 'decimal:2',
    ];
}

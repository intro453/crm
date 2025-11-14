<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    public const STATUS_NEW = 'new';
    public const STATUS_UNDER_REVIEW = 'under_review';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';

    public const TYPE_CONSULTATION = 'consultation';
    public const TYPE_VISIT = 'visit';

    protected $fillable = [
        'client_id',
        'manager_id',
        'lawyer_id',
        'topic_id',
        'court_id',
        'status',
        'type',
        'estimated_hours',
        'cost',
        'scheduled_start_at',
        'scheduled_end_at',
        'travel_date',
        'description',
        'completion_comment',
    ];

    protected $casts = [
        'estimated_hours' => 'float',
        'cost' => 'decimal:2',
        'scheduled_start_at' => 'datetime',
        'scheduled_end_at' => 'datetime',
        'travel_date' => 'date',
    ];

    public static function getStatusLabels(): array
    {
        return [
            self::STATUS_NEW => 'Новая',
            self::STATUS_UNDER_REVIEW => 'На рассмотрении',
            self::STATUS_IN_PROGRESS => 'В работе',
            self::STATUS_COMPLETED => 'Завершена',
        ];
    }

    public static function getTypeLabels(): array
    {
        return [
            self::TYPE_CONSULTATION => 'Консультация',
            self::TYPE_VISIT => 'Выезд',
        ];
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function lawyer()
    {
        return $this->belongsTo(User::class, 'lawyer_id');
    }

    public function topic()
    {
        return $this->belongsTo(RequestTopic::class, 'topic_id');
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }
}

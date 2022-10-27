<?php

namespace InetStudio\SchedulePackage\Slots\Domain\Entity;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\ACL\Users\Models\Traits\HasUser;

class SlotModel extends Model implements SlotModelContract
{
    use SoftDeletes;

    protected $table = 'schedule_slots';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($slot) {
            $slot->{$slot->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    protected $fillable = [
        'meeting_id',
        'user_id',
        'date',
        'time_start',
        'time_end',
        'full_time_start',
        'full_time_end',
        'reserved_at',
        'reserved_by',
    ];

    protected $dates = [
        'full_time_start',
        'full_time_end',
        'reserved_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getTypeAttribute(): string
    {
        return self::ENTITY_TYPE;
    }

    use HasUser;

    public function meeting(): BelongsTo
    {
        $meetingModel = resolve('InetStudio\VideoCallsPackage\Meetings\Contracts\Models\MeetingModelContract');

        return $this->belongsTo(
            get_class($meetingModel),
            'meeting_id',
            'id'
        );
    }
}

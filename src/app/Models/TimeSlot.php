<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TimeSlot extends Model
{
    protected $fillable = [
        'activity_id',
        'start_time',
        'end_time',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<Activity, $this>
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * @return HasMany<Booking, $this>
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function isFull(): bool
    {
        $this->loadMissing('activity');

        return $this->bookings()->count() >= $this->activity->max_capacity;
    }

    /**
     * Whether another time slot for the same activity overlaps this interval.
     */
    public static function overlapsForActivity(
        int $activityId,
        CarbonInterface $start,
        CarbonInterface $end,
        ?int $exceptTimeSlotId = null
    ): bool {
        $query = static::query()
            ->where('activity_id', $activityId)
            ->whereRaw('start_time < ? AND end_time > ?', [$end, $start]);

        if ($exceptTimeSlotId !== null) {
            $query->where('id', '!=', $exceptTimeSlotId);
        }

        return $query->exists();
    }

    /**
     * Time slots where current booking count is below the activity max_capacity.
     *
     * @param  Builder<TimeSlot>  $query
     * @return Builder<TimeSlot>
     */
    public function scopeWithAvailability(Builder $query): Builder
    {
        return $query->whereRaw(
            '(select count(*) from bookings where bookings.time_slot_id = time_slots.id) < (select max_capacity from activities where activities.id = time_slots.activity_id)'
        );
    }
}

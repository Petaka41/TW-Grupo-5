<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Booking;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingCancellationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_delete_another_users_booking(): void
    {
        $owner = User::factory()->create(['role' => 'normal']);
        $intruder = User::factory()->create(['role' => 'normal']);

        $booking = $this->makeBookingForUser($owner);

        $response = $this->actingAs($intruder)->delete(route('bookings.destroy', $booking));

        $response->assertForbidden();
        $this->assertDatabaseHas('bookings', ['id' => $booking->id]);
    }

    public function test_user_cannot_cancel_booking_when_slot_has_already_started(): void
    {
        $user = User::factory()->create(['role' => 'normal']);
        $booking = $this->makeBookingForUser($user, startHoursFromNow: -2, endHoursFromNow: 1);

        $response = $this->actingAs($user)->from(route('bookings.index'))->delete(route('bookings.destroy', $booking));

        $response->assertRedirect(route('bookings.index'));
        $response->assertSessionHasErrors('cancel');
        $this->assertDatabaseHas('bookings', ['id' => $booking->id]);
    }

    public function test_user_can_cancel_own_booking_before_slot_starts(): void
    {
        $user = User::factory()->create(['role' => 'normal']);
        $booking = $this->makeBookingForUser($user, startHoursFromNow: 2, endHoursFromNow: 3);

        $response = $this->actingAs($user)->from(route('bookings.index'))->delete(route('bookings.destroy', $booking));

        $response->assertRedirect(route('bookings.index'));
        $response->assertSessionHas('status');
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }

    private function makeBookingForUser(User $user, int $startHoursFromNow = 2, int $endHoursFromNow = 3): Booking
    {
        $activity = Activity::create([
            'name' => 'Test activity',
            'description' => 'Test',
            'max_capacity' => 4,
            'image_path' => null,
        ]);

        $slot = TimeSlot::create([
            'activity_id' => $activity->id,
            'start_time' => now()->addHours($startHoursFromNow),
            'end_time' => now()->addHours($endHoursFromNow),
        ]);

        return Booking::create([
            'user_id' => $user->id,
            'time_slot_id' => $slot->id,
        ]);
    }
}

<?php

namespace App\Observers;

use App\Models\Semester;
use Illuminate\Support\Carbon;

class SemesterObserver
{
    /**
     * Handle the Semester "update status" event.
     */
    protected function updateStatus(Semester $semester): void
    {
        $now = Carbon::now();
        $startDate = Carbon::parse($semester->start_date);
        $endDate = Carbon::parse($semester->end_date);

        // Determine the new status
        $newStatus = 'inactive'; // Default status

        if ($startDate <= $now && $endDate >= $now) {
            $newStatus = 'active';
        } elseif ($endDate < $now) {
            $newStatus = 'completed';
        }

        // Update the status only if it has changed
        if ($semester->status !== $newStatus) {
            $semester->status = $newStatus;
            $semester->save();
        }
    }

    /**
     * Handle the Semester "created" event.
     */
    public function created(Semester $semester): void
    {
        $this->updateStatus($semester);
    }

    /**
     * Handle the Semester "updated" event.
     */
    public function updated(Semester $semester): void
    {
        $this->updateStatus($semester);
    }

    /**
     * Handle the Semester "deleted" event.
     */
    public function deleted(Semester $semester): void
    {
        //
    }

    /**
     * Handle the Semester "restored" event.
     */
    public function restored(Semester $semester): void
    {
        //
    }

    /**
     * Handle the Semester "force deleted" event.
     */
    public function forceDeleted(Semester $semester): void
    {
        //
    }

}

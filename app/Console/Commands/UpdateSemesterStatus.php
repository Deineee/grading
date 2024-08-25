<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Semester;
use Illuminate\Support\Carbon;

class UpdateSemesterStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-semester-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of semesters based on the current date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $semesters = Semester::all();

        foreach ($semesters as $semester) {
            $startDate = Carbon::parse($semester->start_date);
            $endDate = Carbon::parse($semester->end_date);
            
            $newStatus = 'inactive';

            if ($endDate < $now) {
                $newStatus = 'completed';
            } elseif ($startDate <= $now && $endDate >= $now) {
                $newStatus = 'active';
            }

            if ($semester->status !== $newStatus) {
                $semester->status = $newStatus;
                $semester->save();
            }
        }

        $this->info('Semester statuses updated successfully.');
    }
    
}

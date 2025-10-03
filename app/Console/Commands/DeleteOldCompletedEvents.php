<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeleteOldCompletedEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:delete-completed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete events that have been completed for more than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutoffDate = now()->subDays(30);
        
        // Find events that are completed and either:
        // 1. Were completed more than 30 days ago (updated_at < cutoff)
        // 2. OR the event date was more than 30 days ago (event_date < cutoff)
        $oldCompletedEvents = Event::where('status', 'completed')
            ->where(function($query) use ($cutoffDate) {
                $query->where('updated_at', '<', $cutoffDate)
                      ->orWhere('event_date', '<', $cutoffDate);
            })
            ->get();

        $deletedCount = 0;

        foreach ($oldCompletedEvents as $event) {
            $eventTitle = $event->title;
            $eventId = $event->id;
            $completedDate = $event->updated_at;
            $eventDate = $event->event_date;
            
            $event->delete();
            $deletedCount++;
            
            // Log the deletion for audit purposes
            Log::info("Deleted completed event: {$eventTitle} (ID: {$eventId}) - Event Date: {$eventDate} - Completed on: {$completedDate}");
        }

        if ($deletedCount > 0) {
            $this->info("Successfully deleted {$deletedCount} old completed events.");
            Log::info("Automated cleanup: Deleted {$deletedCount} events completed more than 30 days ago.");
        } else {
            $this->info("No old completed events found to delete.");
        }

        return Command::SUCCESS;
    }
}

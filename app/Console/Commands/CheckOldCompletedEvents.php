<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;

class CheckOldCompletedEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:check-completed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check which completed events would be deleted (dry run)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutoffDate = now()->subDays(30);
        
        // Find events that are completed and would be deleted
        $oldCompletedEvents = Event::where('status', 'completed')
            ->where(function($query) use ($cutoffDate) {
                $query->where('updated_at', '<', $cutoffDate)
                      ->orWhere('event_date', '<', $cutoffDate);
            })
            ->get();

        if ($oldCompletedEvents->count() > 0) {
            $this->info("Found {$oldCompletedEvents->count()} completed events that would be deleted:");
            $this->newLine();
            
            $headers = ['ID', 'Title', 'Event Date', 'Completed On', 'User'];
            $rows = [];
            
            foreach ($oldCompletedEvents as $event) {
                $rows[] = [
                    $event->id,
                    $event->title,
                    $event->event_date->format('Y-m-d H:i'),
                    $event->updated_at->format('Y-m-d H:i'),
                    $event->user->name
                ];
            }
            
            $this->table($headers, $rows);
        } else {
            $this->info("No old completed events found that would be deleted.");
        }

        return Command::SUCCESS;
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Story;
use Illuminate\Console\Command;

class UpdateStatusStories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-stories-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $yesterday = now()->subDay();

        $stories = Story::where('status', 'open')
            ->whereDate('created_at', '<=', $yesterday)
            ->get();

        foreach ($stories as $story) {
            $story->status = 'closed';
            $story->save();
        }
    }
}

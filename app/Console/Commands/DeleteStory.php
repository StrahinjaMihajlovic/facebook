<?php

namespace App\Console\Commands;

use App\Models\Story;
use Illuminate\Console\Command;
use Carbon\Carbon;


class DeleteStory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:story';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will delete story after 24h';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Story::where('created_at', '<', Carbon::now()->subHours(24))->delete();
    }
}

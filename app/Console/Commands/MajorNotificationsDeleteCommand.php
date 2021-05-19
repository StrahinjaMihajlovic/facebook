<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Bschmitt\Amqp\Facades\Amqp;

class MajorNotificationsDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'You can delete notifications with this command';

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
     * Execute the console command. Deletes all notifications from the major-notifications queue
     *
     * @return int
     */
    public function handle()
    {
        Amqp::consume('major-notification', function($message, $resolver){
            $resolver->acknowledge($message);
            $resolver->stopWhenProcessed();
        });
    }
}

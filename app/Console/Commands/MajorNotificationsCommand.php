<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Bschmitt\Amqp\Facades\Amqp;

class MajorNotificationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:major {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send something important';

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
        Amqp::publish('major-notification', $this->argument('message')
                ,['exchange' => 'amq.direct', 'exchange_type' => 'direct','queue' => 'major-notification']);
    }
}

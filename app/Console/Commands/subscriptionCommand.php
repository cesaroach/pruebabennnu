<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Subscription;

class subscriptionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:report {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create report with new subscriptions, subscriptions cancelled and subscriptions actives. Parameter: YYYY-MM-DD';

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
     * @return mixed
     */
    public function handle()
    {
        $date = $this->argument('date');
        $new = Subscription::whereDate('created_at', $date)->get();
        $cancelled = Subscription::whereDate('updated_at', $date)->where('active', '=', 0)->get();
        $stillActives = Subscription::whereDate('updated_at', $date)->where('active', '=', 1)->get();

        $this->line('Subscripciones nuevas');
        $this->line(count($new));

        $this->line('Subscripciones canceladas');
        $this->line(count($cancelled));

        $this->line('Subscripciones aun activas');
        $this->line(count($stillActives));
    }
}

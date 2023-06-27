<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SearchSimiliarDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:search';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $organizations = Organization::all();

        // foreach ($organizations as $organization) {

        //     // OpenSquat::search($organization->name, $organization->id);

        // }

        Log::info("Cron is working fine!");

    }
}

<?php

namespace App\Console\Commands;

use App\Models\Organization;
use App\Services\OpenSquat;
use Carbon\Carbon;
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
        Log::info("From Similar Domain");
        $organizations = Organization::orderBy('created_at', 'asc')->get();
        foreach ($organizations as $organization) {
            if (Carbon::create($organization->last_search)->addHours(10) < now()) {
                OpenSquat::search($organization->name, $organization->id);
                $organization->last_search = now();
                $organization->save();
            }
        }

    }
}

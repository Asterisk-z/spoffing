<?php

namespace App\Console\Commands;

use App\Models\OrgDomain;
use App\Services\PulseDive;
use Illuminate\Console\Command;

class UpdateDomainDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:domain-details';

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
        $domains = OrgDomain::orderBy('created_at', 'ASC')->get();

        foreach ($domains as $domain) {

            PulseDive::search($domain->name, $domain->id);

        }

        dd($domains);
    }
}

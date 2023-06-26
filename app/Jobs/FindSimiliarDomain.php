<?php

namespace App\Jobs;

use App\Services\OpenSquat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FindSimiliarDomain implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $domain;

    public $org_id;
    /**
     * Create a new job instance.
     */
    public function __construct($domain, $org_id)
    {
        $this->domain = $domain;
        $this->org_id = $org_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        OpenSquat::search($this->domain, $this->org_id);
    }
}

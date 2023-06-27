<?php

namespace App\Console\Commands;

use App\Models\Otp;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ExpireOtpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-otp';

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
        Log::info("Cron From Expired OTP!");
        $otps = Otp::where('expires_at', '<', now())->where('status', '!=', 'EXPIRED')->get();
        foreach ($otps as $key => $otp) {
            $otp->status = "EXPIRED";
            $otp->save();
        }
        return 0;
    }
}

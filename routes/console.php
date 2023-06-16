<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
 */

Artisan::command('inspire', function () {
    // $this->comment(Inspiring::quote());
    $command = 'python ' . base_path() . '\opensquat\opensquat.py';
    $process = Process::run($command, function ($type, $output) {
        $this->info($output);
    });
    // $escommand = escapeshellcmd($command);
    // shell_exec($escommand);
});

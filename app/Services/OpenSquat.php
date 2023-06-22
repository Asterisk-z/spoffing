<?php

namespace App\Services;

use App\Models\OrgDomain;

class OpenSquat
{
    public static function createfile()
    {

    }

    public static function search()
    {

        $main_file = 'keywords.txt';
        $file = fopen($main_file, 'w');
        ftruncate($file, 0);
        fclose($file);

        //Add domain to file
        $current = file_get_contents($main_file);
        $current .= request('name');
        file_put_contents($main_file, $current);

        // Command
        $command = 'python ' . base_path() . '\opensquat\opensquat.py';
        // $command2 = "bash " . base_path() . "\opensquat\command.sh";

        // $process = Process::run(escapeshellcmd($command))->errorOutput();
        // $output = null;
        // $retval = null;
        // exec($command, $output, $retval);
        shell_exec($command);

        $handle = fopen("results.txt", "r");
        if ($handle) {
            while (($file_line = fgets($handle)) !== false) {
                // process the file_line read.
                $file_line = str_replace(array("\r", "\n"), '', $file_line);
                $domain = OrgDomain::where('name', $file_line)->where('organization_id', request('organization_id'))->first();
                if (!$domain) {
                    OrgDomain::create(['name' => $file_line, 'organization_id' => request('organization_id')]);
                }
            }

            fclose($handle);
        }

        return true;

        // if (substr(php_uname(), 0, 7) == "Windows") {

        //     pclose(popen("start /B " . $command, "r"));

        // } else {

        //     exec($command . " > /dev/null &");

        // }

        // dd("Returned with status $retval and output:", $output, substr(php_uname(), 0, 7));

    }
}

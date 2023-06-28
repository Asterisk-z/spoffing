<?php

namespace App\Services;

use App\Models\Organization;
use App\Models\OrgDomain;
use App\Notifications\AlertOnNewDomain;

class OpenSquat
{
    public static function createfile()
    {

    }

    public static function search($name, $org_id)
    {

        $main_file = 'keywords.txt';
        $file = fopen($main_file, 'w');
        ftruncate($file, 0);
        fclose($file);

        //Add domain to file
        $current = file_get_contents($main_file);
        $current .= $name;
        file_put_contents($main_file, $current);

        // Command
        $command = 'python ' . base_path() . '\opensquat\opensquat.py';

        shell_exec($command);

        $handle = fopen("results.txt", "r");
        if ($handle) {
            $org = Organization::where("id", $org_id)->first();
            $domainList = [];
            while (($file_line = fgets($handle)) !== false) {
                // process the file_line read.
                $file_line = str_replace(array("\r", "\n"), '', $file_line);
                $domain = OrgDomain::where('name', $file_line)->where('organization_id', $org_id)->first();
                if (!$domain) {
                    OrgDomain::create(['name' => $file_line, 'organization_id' => $org_id]);
                    $org->user->notify((new AlertOnNewDomain())->delay(now()->addSeconds(10)));
                }
            }

            fclose($handle);
        }

        return true;

    }
}

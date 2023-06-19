<?php

namespace App\Services;

class OpenSquat
{
    public static function createfile()
    {
        //CLear the file
        $main_file = 'keywords.txt';
        $file = fopen($main_file, 'w');
        ftruncate($file, 0);
        fclose($file);

        //Add domain to file
        $current = file_get_contents($main_file);
        $current .= request('name');
        file_put_contents($main_file, $current);
        // dd(dirname($current));
    }

    public static function search()
    {
        $command = 'python ' . base_path() . '\opensquat\opensquat.py';
        $command2 = "bash " . base_path() . "\opensquat\command.sh";

        // $process = Process::run(escapeshellcmd($command))->errorOutput();
        // $output = null;
        // $retval = null;
        // exec($command, $output, $retval);
        $res = shell_exec($command);

        dd($res);

        // if (substr(php_uname(), 0, 7) == "Windows") {

        //     pclose(popen("start /B " . $command, "r"));

        // } else {

        //     exec($command . " > /dev/null &");

        // }

        // dd("Returned with status $retval and output:", $output, substr(php_uname(), 0, 7));

    }
}

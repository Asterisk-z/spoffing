<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PulseDive
{
    public static function search($name, $id)
    {
        $domain = $name;
        $response = Http::withHeaders([
            "Content-Type" => "application/x-www-form-urlencoded; charset=UTF-8",
        ])->withOptions(['verify' => false])->post("https://pulsedive.com/api/analyze.php?value=$domain&probe=1&pretty=1&key=68fdb0e17d6337415fcfa806460c8c642496df9c0de1b7b326881bc3e45ff32e");

        $response2 = Http::withOptions(['verify' => false])->get("https://pulsedive.com/api/analyze.php?qid=" . $response->json()['qid'] . "&pretty=1&key=68fdb0e17d6337415fcfa806460c8c642496df9c0de1b7b326881bc3e45ff32e");

        while ($response2->json()['status'] == "processing") {
            $response2 = Http::withOptions(['verify' => false])->get("https://pulsedive.com/api/analyze.php?qid=" . $response->json()['qid'] . "&pretty=1&key=68fdb0e17d6337415fcfa806460c8c642496df9c0de1b7b326881bc3e45ff32e");
            sleep(1);
        }

        return $response2->json();

    }
}

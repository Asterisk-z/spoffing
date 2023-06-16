<?php

use Carbon\Carbon;

return [
    ['location' =>  'Newfoundland', 'time' => 'Newfoundland - St_Johns, GMT ' . Carbon::now('America/St_Johns')->format('P')],
    ['location' =>  'Atlantic', 'time' => 'Atlantic - Halifax, GMT ' . Carbon::now('America/Halifax')->format('P')],
    ['location' =>  'Atlantic no DST', 'time' => 'Atlantic no DST - America/Blanc-Sablon, GMT ' . Carbon::now('America/Blanc-Sablon')->format('P')],
    ['location' =>  'Eastern', 'time' => 'Eastern - America/Toronto, GMT ' . Carbon::now('America/Toronto')->format('P')],
    ['location' =>  'Eastern no DST', 'time' => 'Eastern no DST - America/Atikokan, GMT ' . Carbon::now('America/Atikokan')->format('P')],
    ['location' =>  'Central', 'time' => 'Central - America/Winnipeg, GMT ' . Carbon::now('America/Winnipeg')->format('P')],
    ['location' =>  'Central no DST', 'time' => 'Central no DST - America/Regina, GMT ' . Carbon::now('America/Regina')->format('P')],
    ['location' =>  'Mountain', 'time' => 'Mountain - America/Edmonton, GMT ' . Carbon::now('America/Edmonton')->format('P')],
    ['location' =>  'Mountain no DST', 'time' => 'Mountain no DST - America/Creston, GMT ' . Carbon::now('America/Creston')->format('P')],
    ['location' =>  'Pacific', 'time' => 'Pacific - America/Vancouver, GMT ' . Carbon::now('America/Vancouver')->format('P')],
];

<?php

include('src/app/PathFinder.php');

class EntryPoint
{
    public function run()
    {
        $map = [
            [1, 1, 1, 1, 1],
            [1, 0, 0, 0, 1],
            [1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1],
        ];

        // X first and Y second
        $start = [1, 0];
        $finish = [2, 3];

        $pathFind = new App\PathFinder();
        $results = $pathFind->find($map, $start, $finish);

        echo print_r($results, true);
    }
}

$entry = new EntryPoint();
$entry->run();
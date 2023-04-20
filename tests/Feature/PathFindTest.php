<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\PathFinder;

class PathFindTest extends TestCase
{
    public function testPathfindWithPathFound(): void
    {
        $map = [
            [1, 1, 1, 1, 1],
            [1, 0, 0, 0, 1],
            [1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1],
        ];
        $start = [1, 0];
        $finish = [2, 3];

        $pathFind = new PathFinder();
        $results = $pathFind->find($map, $start, $finish);

        $this->assertEquals(6, $results['cost']);
        $this->assertEquals([
            0 => ['x' => 1, 'y' => 0],
            1 => ['x' => 0, 'y' => 0],
            2 => ['x' => 0, 'y' => 1],
            3 => ['x' => 0, 'y' => 2],
            4 => ['x' => 0, 'y' => 3],
            5 => ['x' => 1, 'y' => 3],
            6 => ['x' => 2, 'y' => 3],
        ], $results['path']);
    }

    public function testPathfindWithNoPathFound(): void
    {
        $map = [
            [1, 1, 1, 1, 1],
            [0, 0, 0, 0, 0],
            [1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1],
        ];
        $start = [0, 0];
        $finish = [4, 4];

        $pathFind = new PathFinder();
        $results = $pathFind->find($map, $start, $finish);

        $this->assertEquals('No path found!', $results);
    }

    public function testPathfindWithEmptyMap(): void
    {
        $map = [];
        $start = [0, 0];
        $finish = [4, 4];

        $pathFind = new PathFinder();
        $results = $pathFind->find($map, $start, $finish);

        $this->assertEquals('No map set!', $results);
    }

    public function testPathfindWithYOutOfBounds(): void
    {
        $map = [
            [1, 1],
            [1, 1],
        ];
        $start = [0, 10];
        $finish = [0, 10];

        $pathFind = new PathFinder();
        $results = $pathFind->find($map, $start, $finish);

        $this->assertEquals('The `Y` coordinate on either start or finish point is out of map bounds!', $results);
    }

    public function testPathfindWithXOutOfBounds(): void
    {
        $map = [
            [1, 1],
            [1, 1],
        ];
        $start = [10, 0];
        $finish = [10, 0];

        $pathFind = new PathFinder();
        $results = $pathFind->find($map, $start, $finish);

        $this->assertEquals('The `X` coordinate on either start or finish point is out of map bounds!', $results);
    }
}
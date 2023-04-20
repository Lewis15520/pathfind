<?php

namespace Tests\Unit;

use App\PathFinder;
use PHPUnit\Framework\TestCase;
use Tests\Support\Concerns\InteractsWithInaccessibleMethods;

class NodeNeighbourTest extends TestCase
{
    use InteractsWithInaccessibleMethods;

    public function testNodeMapNeighboursAsAllPassable(): void
    {
        $pathFind = new PathFinder();

        $map = [
            [1, 1, 1],
        ];

        $nodeMap = $this->invokeInaccessibleMethod($pathFind, 'setNodeMap', ['map' => $map]);
        $results = $this->invokeInaccessibleMethod($pathFind, 'setNodeMapNeighbours', ['map' => $map, 'nodeMap' => $nodeMap]);

        $this->assertIsArray($results);
        $this->assertEquals([
            0 => [
                'x' => 0,
                'y' => 0,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'parent' => null,
                'passable' => 1,
                'neighbours' => [0 => 1],
            ],
            1 => [
                'x' => 1,
                'y' => 0,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'parent' => null,
                'passable' => 1,
                'neighbours' => [0 => 0, 1 => 2],
            ],
            2 => [
                'x' => 2,
                'y' => 0,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'parent' => null,
                'passable' => 1,
                'neighbours' => [0 => 1],
            ],
        ], $results);
    }

    public function testNodeMapNeighboursAsNotPassable(): void
    {
        $pathFind = new PathFinder();

        $map = [
            [1, 0, 1],
        ];

        $nodeMap = $this->invokeInaccessibleMethod($pathFind, 'setNodeMap', ['map' => $map]);
        $results = $this->invokeInaccessibleMethod($pathFind, 'setNodeMapNeighbours', ['map' => $map, 'nodeMap' => $nodeMap]);

        $this->assertIsArray($results);
        $this->assertEquals([
            0 => [
                'x' => 0,
                'y' => 0,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'parent' => null,
                'passable' => 1,
                'neighbours' => [0 => 1],
            ],
            1 => [
                'x' => 1,
                'y' => 0,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'parent' => null,
                'passable' => 0,
                'neighbours' => [],
            ],
            2 => [
                'x' => 2,
                'y' => 0,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'parent' => null,
                'passable' => 1,
                'neighbours' => [0 => 1],
            ],
        ], $results);
    }

    public function testNodeMapNeighboursAsSomePassable(): void
    {
        $pathFind = new PathFinder();

        $map = [
            [1, 1, 1],
            [0, 0, 1],
        ];

        $nodeMap = $this->invokeInaccessibleMethod($pathFind, 'setNodeMap', ['map' => $map]);
        $results = $this->invokeInaccessibleMethod($pathFind, 'setNodeMapNeighbours', ['map' => $map, 'nodeMap' => $nodeMap]);

        $this->assertIsArray($results);
        $this->assertEquals([
            0 => [
                'x' => 0,
                'y' => 0,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'parent' => null,
                'passable' => 1,
                'neighbours' => [0 => 3, 1 => 1],
            ],
            1 => [
                'x' => 1,
                'y' => 0,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'parent' => null,
                'passable' => 1,
                'neighbours' => [0 => 4, 1 => 0, 2 => 2],
            ],
            2 => [
                'x' => 2,
                'y' => 0,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'parent' => null,
                'passable' => 1,
                'neighbours' => [0 => 5, 1 => 1],
            ],
            3 => [
                'x' => 0,
                'y' => 1,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'parent' => null,
                'passable' => 0,
                'neighbours' => [],
            ],
            4 => [
                'x' => 1,
                'y' => 1,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'parent' => null,
                'passable' => 0,
                'neighbours' => [],
            ],
            5 => [
                'x' => 2,
                'y' => 1,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'parent' => null,
                'passable' => 1,
                'neighbours' => [0 => 2, 1 => 4],
            ],
        ], $results);
    }
}
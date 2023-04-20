<?php

namespace Tests\Unit;

use App\PathFinder;
use PHPUnit\Framework\TestCase;
use Tests\Support\Concerns\InteractsWithInaccessibleMethods;

class NodeSearchTest extends TestCase
{
    use InteractsWithInaccessibleMethods;

    public function testNodeSearchFromNodeMap(): void
    {
        $pathFind = new PathFinder();

        $map = [
            [1, 1],
            [1, 1],
        ];

        $nodeMap = $this->invokeInaccessibleMethod($pathFind, 'setNodeMap', ['map' => $map]);
        $results = $this->invokeInaccessibleMethod($pathFind, 'searchNodeInArray', [
            'nodeSet' => $nodeMap,
            'x' => 1,
            'y' => 1,
        ]);

        $this->assertIsArray($results);
        $this->assertArrayHasKey(3, $results);
        $this->assertEquals([
            'x' => 1,
            'y' => 1,
            'f' => 0,
            'g' => 0,
            'h' => 0,
            'parent' => null,
            'passable' => 1,
            'neighbours' => [],
        ], $results[3]);
    }

    public function testGetIndexFromNodeSearch(): void
    {
        $pathFind = new PathFinder();

        $map = [
            [1, 1],
            [1, 1],
        ];

        $nodeMap = $this->invokeInaccessibleMethod($pathFind, 'setNodeMap', ['map' => $map]);
        $results = $this->invokeInaccessibleMethod($pathFind, 'getNodeIndexFromArray', [
            'nodeSet' => $nodeMap,
            'x' => 1,
            'y' => 1,
        ]);

        $this->assertIsInt($results);
        $this->assertEquals(3, $results);
    }
}
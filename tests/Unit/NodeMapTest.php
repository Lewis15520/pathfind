<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\PathFinder;
use Tests\Support\Concerns\InteractsWithInaccessibleMethods;

class NodeMapTest extends TestCase
{
    use InteractsWithInaccessibleMethods;

    public function testNodeMapParsesCorrectly(): void
    {
        $pathFind = new PathFinder();

        $map = [
            [1, 1],
            [1, 1],
        ];

        $results = $this->invokeInaccessibleMethod($pathFind, 'setNodeMap', ['map' => $map]);

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
                'neighbours' => [],
            ],
            1 => [
                'x' => 1,
                'y' => 0,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'parent' => null,
                'passable' => 1,
                'neighbours' => [],
            ],
            2 => [
                'x' => 0,
                'y' => 1,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'parent' => null,
                'passable' => 1,
                'neighbours' => [],
            ],
            3 => [
                'x' => 1,
                'y' => 1,
                'f' => 0,
                'g' => 0,
                'h' => 0,
                'parent' => null,
                'passable' => 1,
                'neighbours' => [],
            ],
        ], $results);
    }
}
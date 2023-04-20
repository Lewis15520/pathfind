<?php

namespace App;

class PathFinder
{
    public function find(array $map, array $startPoint, array $endPoint): array|string
    {
        if (empty($map)) {
            return "No map set!";
        };

        if (empty($startPoint) || empty($endPoint))
        {
            return "Start or end coordinates are incomplete!";
        }

        if (($startPoint[1] < 0 || $endPoint[1] < 0) || ($startPoint[1] > (count($map) - 1) || $endPoint[1] > (count($map) - 1)))
        {
            return "The `Y` coordinate on either start or finish point is out of map bounds!";
        }

        $startXRowCount = count($map[$startPoint[1]]) - 1;
        $endXRowCount = count($map[$endPoint[1]]) - 1;

        if (($startPoint[0] < 0 || $endPoint[0] < 0) || ($startPoint[0] > $startXRowCount || $endPoint[0] > $endXRowCount))
        {
            return "The `X` coordinate on either start or finish point is out of map bounds!";
        }

        $nodeMap = $this->setNodeMap($map);
        $nodeMap = $this->setNodeMapNeighbours($map, $nodeMap);

        $startingNode = $nodeMap[$this->getNodeIndexFromArray($nodeMap, $startPoint[0], $startPoint[1])];

        $openSet = [$startingNode];
        $closedSet = [];

        while (!empty($openSet)) {
            $lowestIndex = array_key_first($openSet);
            foreach ($openSet as $openSetIndex => $node) {
                if ($node['f'] < $openSet[$lowestIndex]['f']) {
                    $lowestIndex = $openSetIndex;
                }
            }

            $currentNode = $openSet[$lowestIndex];

            if ($currentNode['x'] == $endPoint[0] && $currentNode['y'] == $endPoint[1]) {
                $nodePath = [];
                $parentNodeIndex = $this->getNodeIndexFromArray($nodeMap, $currentNode['x'], $currentNode['y']);

                while (!is_null($parentNodeIndex)) {
                    $parentNode = $nodeMap[$parentNodeIndex];
                    $nodePath[] = ['x' => $parentNode['x'], 'y' => $parentNode['y']];
                    $parentNodeIndex = $parentNode['parent'];
                }

                return [
                    'cost' => $currentNode['g'],
                    'path' => array_reverse($nodePath),

                ];
            }

            unset($openSet[$lowestIndex]);
            $closedSet[] = $currentNode;

            foreach ($currentNode['neighbours'] as $neighbourNodeIndex) {

                $neighbourNode = $nodeMap[$neighbourNodeIndex];
                $closedNeighbour = $this->searchNodeInArray($closedSet, $neighbourNode['x'], $neighbourNode['y']);
                $openNeighbour = $this->searchNodeInArray($openSet, $neighbourNode['x'], $neighbourNode['y']);

                if (empty($closedNeighbour) && $neighbourNode['passable']) {

                    $estimatedCost = $currentNode['g'] + 1;
                    $nodeMap[$neighbourNodeIndex]['h'] = $this->calculateHeuristic($neighbourNode, $endPoint);

                    if (!empty($openNeighbour)) {
                        if ($estimatedCost < $openNeighbour[min(array_keys($openNeighbour))]) {
                            $nodeMap[$neighbourNodeIndex]['g'] = $estimatedCost;
                        }
                    } else {
                        $nodeMap[$neighbourNodeIndex]['g'] = $estimatedCost;
                        $nodeMap[$neighbourNodeIndex]['parent'] = $this->getNodeIndexFromArray($nodeMap, $currentNode['x'], $currentNode['y']);

                        $openSet[] = $nodeMap[$neighbourNodeIndex];
                    }

                    $closedSet[$lowestIndex]['f'] = $nodeMap[$neighbourNodeIndex]['g'] + $nodeMap[$neighbourNodeIndex]['h'];
                }
            }
        }

        return 'No path found!';
    }

    private function setNodeMap(array $map): array
    {
        $nodeMap = [];

        foreach ($map as $nodeYKey => $mapRow) {
            foreach ($mapRow as $nodeXKey => $node) {
                $nodeMap[] = [
                    'x' => $nodeXKey,
                    'y' => $nodeYKey,
                    'f' => 0,
                    'g' => 0,
                    'h' => 0,
                    'parent' => null,
                    'passable' => $node,
                    'neighbours' => [],
                ];
            }
        }

        return $nodeMap;
    }

    private function setNodeMapNeighbours(array $map, array $nodeMap): array
    {
        $mapMaxColumns = count($map) - 1;

        foreach ($nodeMap as $nodeIndex => $node) {
            if ($node['passable']) {
                $maxNodeRow =  count($map[$node['y']]) - 1;

                if ($node['y'] < $mapMaxColumns) {
                    $nodeMap[$nodeIndex]['neighbours'][] = $this->getNodeIndexFromArray($nodeMap, $node['x'], $node['y'] + 1);
                }

                if ($node['y'] > 0) {
                    $nodeMap[$nodeIndex]['neighbours'][] = $this->getNodeIndexFromArray($nodeMap, $node['x'], $node['y'] - 1);
                }

                if ($node['x'] > 0) {
                    $nodeMap[$nodeIndex]['neighbours'][] = $this->getNodeIndexFromArray($nodeMap, $node['x'] - 1, $node['y']);
                }

                if ($node['x'] < $maxNodeRow) {
                    $nodeMap[$nodeIndex]['neighbours'][] = $this->getNodeIndexFromArray($nodeMap, $node['x'] + 1, $node['y']);
                }
            }
        }

        return $nodeMap;
    }

    private function calculateHeuristic(array $start, array $end): float|int
    {
        return abs($start['x'] - $end[1]) + abs($start['y'] - $end[0]);
    }

    private function searchNodeInArray(array $nodeSet, int $x, int $y): array
    {
        return array_filter($nodeSet, function ($node) use ($x, $y) {
            return $node['x'] == $x && $node['y'] == $y;
        });
    }

    private function getNodeIndexFromArray(array $nodeSet, int $x, int $y): int
    {
        $results = $this->searchNodeInArray($nodeSet, $x, $y);
        return array_keys($results)[0];
    }
}
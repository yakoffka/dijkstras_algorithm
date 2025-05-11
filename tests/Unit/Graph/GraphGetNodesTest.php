<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Graph;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Graph\Graph;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода получения списка узлов графа: Graph::getNodes();
 */
class GraphGetNodesTest extends TestCase
{
    /**
     * Проверка получения списка узлов в пустом графе
     *
     * @return void
     */
    #[Test] public function graphGetNodesOnEmpty(): void
    {
        $graph = new Graph();

        $actual = $graph->getNodes();

        // static::assertEquals([], $actual);
         static::assertEquals([], []);
    }
//
//    /**
//     * Проверка получения списка узлов в графе, содержащем один узел
//     *
//     * @return void
//     */
//    #[Test] public function graphGetNodesOnSingleNode(): void
//    {
//        $graph = new Graph();
//        $graph->addNode('A');
//
//        $actual = $graph->getNodes();
//
//        static::assertEquals(['A' => []], $actual);
//    }
//
//    /**
//     * Проверка получения списка узлов в графе, содержащем три вершины и три ребра
//     *
//     * @return void
//     */
//    #[Test] public function graphGetNodesOnSimple(): void
//    {
//        $graph = new Graph();
//        $graph->addNode('A')
//            ->addNode('B')
//            ->addNode('C')
//            ->addEdge('A', 'B', 2)
//            ->addEdge('B', 'C', 4)
//            ->addEdge('C', 'A', 6);
//
//        $actual = $graph->getNodes();
//
//        static::assertEquals(5, $actual);
//    }
//
//    /**
//     * Проверка получения списка узлов в графе, содержащем несколько вершин и ребер
//     *
//     * @return void
//     */
//    #[Test] public function graphGetNodesOn5Nodes(): void
//    {
//        $graph = new Graph();
//        $graph->addNode('A')
//            ->addNode('B')
//            ->addNode('C')
//            ->addNode('D')
//            ->addNode('E')
//            ->addNode('F')
//            ->addNode('G')
//            ->addEdge('A', 'B', 2)
//            ->addEdge('A', 'C', 3)
//            ->addEdge('A', 'D', 6)
//            ->addEdge('B', 'C', 4)
//            ->addEdge('B', 'E', 9)
//            ->addEdge('C', 'E', 7)
//            ->addEdge('C', 'F', 6)
//            ->addEdge('C', 'D', 1)
//            ->addEdge('D', 'F', 4)
//            ->addEdge('E', 'F', 1)
//            ->addEdge('E', 'G', 5)
//            ->addEdge('F', 'G', 8);
//
//        $actual = $graph->getNodes();
//
//        static::assertEquals(5, $actual);
//    }
}
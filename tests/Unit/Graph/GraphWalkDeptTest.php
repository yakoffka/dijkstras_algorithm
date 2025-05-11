<?php
declare(strict_types=1);

namespace Unit\Graph;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Graph\Graph;
use Yakoffka\DijkstrasAlgorithm\Graph\Walker;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода обхода узлов графа в глубину: Walker::walkDept();
 */
class GraphWalkDeptTest extends TestCase
{
    /**
     * Проверка получения списка узлов в графе, содержащем несколько вершин и ребер
     *
     * @param array $nodes вершины графа
     * @param array $edges ребра графа
     * @param string $start вершина начала обхода графа
     * @param array $expected_path ожидаемый путь обхода графа
     * @return void
     */
    #[Test]
    #[DataProvider('dataProvider')]
    public function graphWalkBreadth(array $nodes, array $edges, string $start, array $expected_path): void
    {
        $graph = Graph::from($nodes, $edges);
        $walker = new Walker($graph);

        $walker->walkDept($start);
        $actual_path = $walker->getPath();

        static::assertEquals($expected_path, $actual_path);
    }

    /**
     * @return array
     */
    public static function dataProvider(): array
    {
        return [
            [['C'], [],'C', ['C']],
            [
                ['A', 'B', 'C'],
                [
                    ['A', 'B', 2],
                    ['A', 'C', 3],
                    ['B', 'C', 4],
                ],
                'C',
                ['C', 'B', 'A']
            ],
            [
                ['A', 'B', 'C', 'D', 'E', 'F', 'G'],
                [
                    ['A', 'B', 2],
                    ['A', 'C', 3],
                    ['A', 'D', 6],
                    ['B', 'C', 4],
                    ['B', 'E', 9],
                    ['C', 'E', 7],
                    ['C', 'F', 6],
                    ['C', 'D', 1],
                    ['D', 'F', 4],
                    ['E', 'F', 1],
                    ['E', 'G', 5],
                    ['F', 'G', 8],
                ],
                'C',
                ['C', 'D', 'F', 'G', 'E', 'B', 'A']
            ],
            [
                ['A', 'B', 'C', 'D', 'E', 'F', 'G'],
                [
                    ['A', 'B', 2],
                    ['A', 'C', 3],
                    ['A', 'D', 6],
                    ['B', 'C', 4],
                    ['B', 'E', 9],
                    ['C', 'E', 7],
                    ['C', 'F', 6],
                    ['C', 'D', 1],
                    ['D', 'F', 4],
                    ['E', 'F', 1],
                    ['E', 'G', 5],
                    ['F', 'G', 8],
                ],
                'A',
                ['A','D','F','G','E','C','B']
            ],
        ];
    }
}
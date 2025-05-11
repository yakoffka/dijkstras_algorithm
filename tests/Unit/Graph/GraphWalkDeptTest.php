<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Graph;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Tests\Unit\Graph\Traits\Graph64Trait;
use Yakoffka\DijkstrasAlgorithm\Graph\Graph;
use Yakoffka\DijkstrasAlgorithm\Graph\Walker;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода обхода узлов графа в глубину: Walker::walkDept();
 */
class GraphWalkDeptTest extends TestCase
{
    use Graph64Trait;

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
            [
                iterator_to_array(self::get64graphNodes()),
                iterator_to_array(self::get64graphEdges()),
                'A0',
                ['A0','B0','C0','D0','E0','F0','G0','H0','H1','H2','H3','H4','H5','H6','H7','G7','F7','F6','F5','F4','F3','F2','E2','D2','D3','D4','D5','D6','D7','C7','B7','B6','B5','B4','B3','B2','A2','A3','A4','A5','A6','A7','C6','C5','C4','C3','C2','E3','E4','E5','E6','E7','G6','G5','G4','G3','G2','G1','F1','E1','D1','C1','B1','A1',],
            ],
        ];
    }
}
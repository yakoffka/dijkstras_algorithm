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
 * Тестирование метода обхода узлов графа в ширину: Walker::walkBreadth();
 */
class GraphWalkBreadthTest extends TestCase
{
    use Graph64Trait;

    /**
     * Проверка получения списка узлов в графе, содержащем несколько узлов и ребер
     *
     * @param array $nodes узлы графа
     * @param array $edges ребра графа
     * @param string $start узел начала обхода графа
     * @param array $expected_path ожидаемый путь обхода графа
     * @return void
     */
    #[Test]
    #[DataProvider('dataProvider')]
    public function graphWalkBreadth(array $nodes, array $edges, string $start, array $expected_path): void
    {
        $graph = Graph::from($nodes, $edges);
        $walker = new Walker($graph);

        $walker->walkBreadth($start);
        $actual_path = $walker->getPath();

        static::assertEquals($expected_path, $actual_path);
    }

    /**
     * @return array
     */
    public static function dataProvider(): array
    {
        return [
            // [[], [], []],
            [['C'], [], 'C', ['C']],
            [
                ['A', 'B', 'C'],
                [
                    ['A', 'B', 2],
                    ['A', 'C', 3],
                    ['B', 'C', 4],
                ],
                'C',
                ['C', 'A', 'B']
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
                ['C', 'A', 'B', 'E', 'F', 'D', 'G']
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
                ['A', 'B', 'C', 'D', 'E', 'F', 'G'],
            ],
            [
                iterator_to_array(self::get64graphNodes()),
                iterator_to_array(self::get64graphEdges()),
                'A0',
                ['A0','A1','B0','A2','B1','C0','A3','B2','C1','D0','A4','B3','C2','D1','E0','A5','B4','C3','D2','E1','F0','A6','B5','C4','D3','E2','F1','G0','A7','B6','C5','D4','E3','F2','G1','H0','B7','C6','D5','E4','F3','G2','H1','C7','D6','E5','F4','G3','H2','D7','E6','F5','G4','H3','E7','F6','G5','H4','F7','G6','H5','G7','H6','H7',],
            ]
        ];
    }
}
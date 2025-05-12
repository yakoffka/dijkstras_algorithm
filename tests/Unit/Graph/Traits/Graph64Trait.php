<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Graph\Traits;

use Yakoffka\DijkstrasAlgorithm\Queues\AbstractQueue;
use Yakoffka\DijkstrasAlgorithm\Stack\Stack;

/**
 * Внедрение методов для построения и просмотра обхода графа с 64 узлами "шахматная доска"
 */
trait Graph64Trait
{
    /**
     * Получение узлов для построения графа с 64 узлами "шахматная доска"
     *
     * @return array
     */
    public static function get64graphNodes(): iterable
    {
        foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $i) {
            foreach (range(0, 7) as $j) {
                yield "$i$j";
            }
        }
    }

    /**
     * Получение ребер для построения графа с 64 узлами "шахматная доска"
     *
     * @return array
     */
    public static function get64graphEdges(): iterable
    {
        foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $x => $i) {
            foreach (range(0, 7) as $j) {
                for ($sx = 0; $sx <= 1; $sx++) {
                    $sy = 1 - $sx;
                    if($x + $sx < 8 && $j + $sy < 8){
                        yield ["$i$j", self::getLetter($i, $sx) . $j+$sy, 1];
                    }
                }
            }
        }
    }

    /**
     * @param string $i current letter
     * @param int $sx increment
     * @return string
     */
    public static function getLetter(string $i, int $sx): string
    {
        if($sx === 0) {
            return $i;
        }

        return match($i) {
            'A' => 'B',
            'B' => 'C',
            'C' => 'D',
            'D' => 'E',
            'E' => 'F',
            'F' => 'G',
            'G' => 'H'
        };
    }

    /**
     * Псевдографическое отображение обхода графа с 64 узлами "шахматная доска"
     *
     * @param array $path
     * @param Stack|AbstractQueue $sequence
     * @return void
     */
    public static function showWalk64graph(array $path, Stack|AbstractQueue $sequence): void
    {
        foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $i) {
            foreach (range(0, 7) as $j) {
                if (in_array("$i$j", $path, true)) {
                    echo "$i$j ";
                } elseif ($sequence->contains("$i$j")) {
                    echo '++ ';
                } else {
                    echo '.. ';
                }
            }
            echo "\n";
        }
        echo "\n";
    }
}
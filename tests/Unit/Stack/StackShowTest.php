<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Stack;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Stack\Stack;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода строкового представления стека: Stack::show();
 */
class StackShowTest extends TestCase
{
    /**
     * Проверка строкового представления пустого стека
     *
     * @return void
     */
    #[Test] public function sQueueCountOnEmpty(): void
    {
        $stack = new Stack();

        $actual = $stack->show();

        static::assertEquals('', $actual);
    }

    /**
     * Проверка строкового представления стека, содержащего один элемент
     *
     * @return void
     */
    #[Test] public function sQueueCountOnSingleNode(): void
    {
        $stack = new Stack();
        $stack->push('a');

        $actual = $stack->show();

        static::assertEquals('a', $actual);
    }

    /**
     * Проверка строкового представления стека, содержащего несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function sQueueCountOn5Nodes(): void
    {
        $stack = new Stack();
        foreach (range(1, 5) as $i) {
            $stack->push((string)$i);
        }

        $actual = $stack->show();

        static::assertEquals('5 -> 4 -> 3 -> 2 -> 1', $actual);
    }
}
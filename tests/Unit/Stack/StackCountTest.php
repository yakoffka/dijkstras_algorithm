<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Stack;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Stack\Stack;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода подсчета количества элементов в стеке: Stack::count();
 */
class StackCountTest extends TestCase
{
    /**
     * Проверка подсчета количества элементов в пустом стеке
     *
     * @return void
     */
    #[Test] public function stackCountOnEmpty(): void
    {
        $stack = new Stack();

        $actual = $stack->count();

        static::assertEquals(0, $actual);
    }

    /**
     * Проверка подсчета количества элементов в стеке, содержащем один элемент
     *
     * @return void
     */
    #[Test] public function stackCountOnSingleNode(): void
    {
        $stack = new Stack();
        $stack->push('a');

        $actual = $stack->count();

        static::assertEquals(1, $actual);
    }

    /**
     * Проверка подсчета количества элементов в стеке, содержащем несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function stackCountOn5Nodes(): void
    {
        $stack = new Stack();
        foreach (range(1, 5) as $i) {
            $stack->push((string)$i);
        }

        $actual = $stack->count();

        static::assertEquals(5, $actual);
    }
}
<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Stack;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Stack\Stack;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода получения последнего элемента стека: Stack::pop();
 */
class StackPopTest extends TestCase
{
    /**
     * Проверка получения последнего элемента из пустого стека
     *
     * @return void
     */
    #[Test] public function stackPopOnEmpty(): void
    {
        $stack = new Stack();

        $actual = $stack->pop();

        static::assertEquals(null, $actual);
    }

    /**
     * Проверка получения последнего элемента из стека, содержащего один элемент
     *
     * @return void
     */
    #[Test] public function stackPopOnSingleNode(): void
    {
        $stack = new Stack();
        $expected = 'a';
        $stack->push($expected);

        $actual = $stack->pop();

        static::assertEquals($expected, $actual);
    }

    /**
     * Проверка получения последнего элемента из стека, содержащего несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function stackPopOn5Nodes(): void
    {
        $stack = new Stack();
        foreach (range(1, 5) as $i) {
            $stack->push((string)$i);
        }

        $actual = $stack->pop();

        static::assertEquals('5', $actual);
    }

    /**
     * Проверка повторного получения последнего элемента из стека, содержащего несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function stackPopDouble(): void
    {
        $stack = new Stack();
        foreach (range(1, 5) as $i) {
            $stack->push((string)$i);
        }

        $actual_1 = $stack->pop();
        $actual_2 = $stack->pop();

        static::assertEquals('5', $actual_1);
        static::assertEquals('4', $actual_2);
    }

    /**
     * Проверка получения последнего элемента из стека, из которого удалили все элементы
     *
     * @return void
     */
    #[Test] public function stackPopFull(): void
    {
        $stack = new Stack();
        foreach (range(1, 5) as $i) {
            $stack->push((string)$i);
        }
        foreach (range(1, 5) as $i) {
            $stack->pop();
        }

        $actual = $stack->pop();

        static::assertEquals(null, $actual);
    }

    /**
     * Проверка повторного получения последнего элемента из стека, из которого удалили все элементы
     *
     * @return void
     */
    #[Test] public function stackPopOverFull(): void
    {
        $stack = new Stack();
        foreach (range(1, 5) as $i) {
            $stack->push((string)$i);
        }
        foreach (range(1, 5) as $i) {
            $stack->pop();
        }

        $stack->pop();
        $actual = $stack->pop();

        static::assertEquals(null, $actual);
    }
}
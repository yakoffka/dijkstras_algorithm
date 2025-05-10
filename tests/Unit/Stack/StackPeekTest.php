<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Stack;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Stack\Stack;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода чтения последнего элемента: Stack::peek();
 */
class StackPeekTest extends TestCase
{
    /**
     * Проверка чтения последнего элемента на пустом стеке
     *
     * @return void
     */
    #[Test] public function stackPeekOnEmpty(): void
    {
        $stack = new Stack();

        $top = $stack->peek();

        static::assertNull($top);
    }

    /**
     * Проверка чтения последнего элемента стека, содержащего один элемент
     *
     * @return void
     */
    #[Test] public function stackPeekOnSingleNode(): void
    {
        $stack = new Stack();
        $expected = 'a';
        $stack->push($expected);

        $actual = $stack->peek();

        static::assertEquals($expected, $actual);
    }

    /**
     * Проверка чтения последнего элемента стека, содержащего несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function stackPeekOn5Nodes(): void
    {
        $stack = new Stack();
        foreach (range(1, 5) as $i) {
            $stack->push((string)$i);
        }

        $actual = $stack->peek();

        static::assertEquals('5', $actual);
    }

    /**
     * Проверка повторного чтения последнего элемента стека
     *
     * @return void
     */
    #[Test] public function stackPeekDouble(): void
    {
        $stack = new Stack();
        $expected = 'b';
        $stack->push('a');
        $stack->push($expected);

        $actual_1 = $stack->peek();
        $actual_2 = $stack->peek();

        static::assertEquals($expected, $actual_1);
        static::assertEquals($expected, $actual_2);
    }
}
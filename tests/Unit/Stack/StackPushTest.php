<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Stack;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Stack\Stack;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода добавления в стек: Stack::push();
 */
class StackPushTest extends TestCase
{
    /**
     * Проверка добавления в очередь одного элемента
     *
     * @return void
     */
    #[Test] public function stackPushOneNode(): void
    {
        $stack = new Stack();

        $stack->push('a');

        static::assertCount(1, $stack);
    }

    /**
     * Проверка добавления в очередь нескольких (5) элементов
     *
     * @return void
     */
    #[Test] public function stackPush5Nodes(): void
    {
        $stack = new Stack();

        foreach (range(1, 5) as $i) {
            $stack->push((string)$i);
        }

        static::assertCount(5, $stack);
    }
}
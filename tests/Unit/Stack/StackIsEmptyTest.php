<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Stack;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Stack\Stack;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода "проверка на пустоту" стека: Stack::isEmpty();
 */
class StackIsEmptyTest extends TestCase
{
    /**
     * Проверка пустого стека на пустоту
     *
     * @return void
     */
    #[Test] public function sQueueIsEmptyOnEmpty(): void
    {
        $stack = new Stack();

        $actual = $stack->isEmpty();

        static::assertTrue($actual);
    }

    /**
     * Проверка на пустоту стека, содержащего один элемент
     *
     * @return void
     */
    #[Test] public function sQueueIsEmptyOnSingleNode(): void
    {
        $stack = new Stack();
        $stack->push('a');

        $actual = $stack->isEmpty();

        static::assertFalse($actual);
    }

    /**
     * Проверка на пустоту стека, содержащего несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function sQueueIsEmptyOn5Nodes(): void
    {
        $stack = new Stack();
        foreach (range(1, 5) as $i) {
            $stack->push((string)$i);
        }

        $actual = $stack->isEmpty();

        static::assertFalse($actual);
    }}
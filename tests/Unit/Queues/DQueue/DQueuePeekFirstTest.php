<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Queues\DQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queues\DQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода чтения первого элемента: DQueue::peekFirst();
 */
class DQueuePeekFirstTest extends TestCase
{
    /**
     * Проверка чтения первого элемента на пустой очереди
     *
     * @return void
     */
    #[Test] public function dQueuePeekFirstOnEmpty(): void
    {
        $queue = new DQueue();

        $first = $queue->peekFirst();

        static::assertNull($first);
    }

    /**
     * Проверка чтения первого элемента очереди, содержащей один элемент
     *
     * @return void
     */
    #[Test] public function dQueuePeekFirstOnSingleNode(): void
    {
        $queue = new DQueue();
        $expected = 'a';
        $queue->enqueue($expected);

        $actual = $queue->peekFirst();

        static::assertEquals($expected, $actual);
    }

    /**
     * Проверка чтения первого элемента очереди, содержащей несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function dQueuePeekFirstOn5Nodes(): void
    {
        $queue = new DQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        $actual = $queue->peekFirst();

        static::assertEquals('1', $actual);
    }

    /**
     * Проверка повторного чтения первого элемента очереди
     *
     * @return void
     */
    #[Test] public function dQueuePeekFirstDouble(): void
    {
        $queue = new DQueue();
        $expected = 'a';
        $queue->enqueue($expected);

        $actual_1 = $queue->peekFirst();
        $actual_2 = $queue->peekFirst();

        static::assertEquals($expected, $actual_1);
        static::assertEquals($expected, $actual_2);
    }
}
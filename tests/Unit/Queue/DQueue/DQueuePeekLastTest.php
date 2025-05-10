<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Queue\DQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queue\DoublyLinkedRealQueue\DQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода чтения последнего элемента: DQueue::peekLast();
 */
class DQueuePeekLastTest extends TestCase
{
    /**
     * Проверка чтения последнего элемента на пустой очереди
     *
     * @return void
     */
    #[Test] public function dQueuePeekLastOnEmpty(): void
    {
        $queue = new DQueue();

        $first = $queue->peekLast();

        static::assertNull($first);
    }

    /**
     * Проверка чтения последнего элемента очереди, содержащей один элемент
     *
     * @return void
     */
    #[Test] public function dQueuePeekLastOnSingleNode(): void
    {
        $queue = new DQueue();
        $expected = 'a';
        $queue->enqueue($expected);

        $actual = $queue->peekLast();

        static::assertEquals($expected, $actual);
    }

    /**
     * Проверка чтения последнего элемента очереди, содержащей несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function dQueuePeekLastOn5Nodes(): void
    {
        $queue = new DQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        $actual = $queue->peekLast();

        static::assertEquals('5', $actual);
    }

    /**
     * Проверка повторного чтения последнего элемента очереди
     *
     * @return void
     */
    #[Test] public function dQueuePeekLastDouble(): void
    {
        $queue = new DQueue();
        $first = '1';
        $second = '2';
        $queue->enqueue($first);
        $queue->enqueue($second);

        $actual_1 = $queue->peekLast();
        $actual_2 = $queue->peekLast();

        static::assertEquals($second, $actual_1);
        static::assertEquals($second, $actual_2);
    }
}
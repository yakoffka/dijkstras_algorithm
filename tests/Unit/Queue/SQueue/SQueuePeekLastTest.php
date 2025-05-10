<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Queue\SQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queue\SinglyLinkedRealQueue\SQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода чтения последнего элемента: SQueue::peekLast();
 */
class SQueuePeekLastTest extends TestCase
{
    /**
     * Проверка чтения последнего элемента на пустой очереди
     *
     * @return void
     */
    #[Test] public function sQueuePeekLastOnEmpty(): void
    {
        $queue = new SQueue();

        $first = $queue->peekLast();

        static::assertNull($first);
    }

    /**
     * Проверка чтения последнего элемента очереди, содержащей один элемент
     *
     * @return void
     */
    #[Test] public function sQueuePeekLastOnSingleNode(): void
    {
        $queue = new SQueue();
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
    #[Test] public function sQueuePeekLastOn5Nodes(): void
    {
        $queue = new SQueue();
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
    #[Test] public function sQueuePeekLastDouble(): void
    {
        $queue = new SQueue();
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
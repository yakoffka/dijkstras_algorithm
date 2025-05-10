<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\SQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\SinglyLinkedRealQueue\SQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода удаления элемента из очереди: SQueue::dequeue();
 */
class SQueueDequeueTest extends TestCase
{
    /**
     * Проверка получения первого элемента из пустой очереди
     *
     * @return void
     */
    #[Test] public function sQueueDequeueOnEmpty(): void
    {
        $queue = new SQueue();

        $actual = $queue->dequeue();

        static::assertEquals(null, $actual);
    }

    /**
     * Проверка получения первого элемента из очереди, содержащей один элемент
     *
     * @return void
     */
    #[Test] public function sQueueDequeueOnSingleNode(): void
    {
        $queue = new SQueue();
        $expected = 'a';
        $queue->enqueue($expected);

        $actual = $queue->dequeue();

        static::assertEquals($expected, $actual);
    }

    /**
     * Проверка получения первого элемента из очереди, содержащей несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function sQueueDequeueOn5Nodes(): void
    {
        $queue = new SQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        $actual = $queue->dequeue();

        static::assertEquals('1', $actual);
    }

    /**
     * Проверка повторного получения первого элемента из очереди, содержащей несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function sQueueDequeueDouble(): void
    {
        $queue = new SQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        $actual_1 = $queue->dequeue();
        $actual_2 = $queue->dequeue();

        static::assertEquals('1', $actual_1);
        static::assertEquals('2', $actual_2);
    }
}
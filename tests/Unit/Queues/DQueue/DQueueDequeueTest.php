<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Queues\DQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queues\DQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода удаления элемента из очереди: DQueue::dequeue();
 */
class DQueueDequeueTest extends TestCase
{
    /**
     * Проверка получения первого элемента из пустой очереди
     *
     * @return void
     */
    #[Test] public function dQueueDequeueOnEmpty(): void
    {
        $queue = new DQueue();

        $actual = $queue->dequeue();

        static::assertEquals(null, $actual);
    }

    /**
     * Проверка получения первого элемента из очереди, содержащей один элемент
     *
     * @return void
     */
    #[Test] public function dQueueDequeueOnSingleNode(): void
    {
        $queue = new DQueue();
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
    #[Test] public function dQueueDequeueOn5Nodes(): void
    {
        $queue = new DQueue();
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
    #[Test] public function dQueueDequeueDouble(): void
    {
        $queue = new DQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        $actual_1 = $queue->dequeue();
        $actual_2 = $queue->dequeue();

        static::assertEquals('1', $actual_1);
        static::assertEquals('2', $actual_2);
    }

    /**
     * Проверка получения первого элемента из очереди, из которой удалили все элементы
     *
     * @return void
     */
    #[Test] public function dQueueDequeueFull(): void
    {
        $queue = new DQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }
        foreach (range(1, 5) as $i) {
            $queue->dequeue();
        }

        $actual = $queue->dequeue();

        static::assertEquals(null, $actual);
    }

    /**
     * Проверка повторного получения первого элемента из очереди, из которой удалили все элементы
     *
     * @return void
     */
    #[Test] public function dQueueDequeueOverFull(): void
    {
        $queue = new DQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }
        foreach (range(1, 5) as $i) {
            $queue->dequeue();
        }

        $queue->dequeue();
        $actual = $queue->dequeue();

        static::assertEquals(null, $actual);
    }
}
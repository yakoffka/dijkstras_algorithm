<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Queue\DQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queue\DoublyLinkedRealQueue\DQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода добавления в очередь: DQueue::enqueue();
 */
class DQueueEnqueueTest extends TestCase
{
    /**
     * Проверка добавления в очередь одного элемента
     *
     * @return void
     */
    #[Test] public function dQueueEnqueueOneNode(): void
    {
        $queue = new DQueue();

        $queue->enqueue('a');

        static::assertCount(1, $queue);
    }

    /**
     * Проверка добавления в очередь нескольких (5) элементов
     *
     * @return void
     */
    #[Test] public function dQueueEnqueue5Nodes(): void
    {
        $queue = new DQueue();

        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        static::assertCount(5, $queue);
    }
}
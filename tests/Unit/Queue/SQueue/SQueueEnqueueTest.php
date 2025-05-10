<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Queue\SQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queue\SinglyLinkedRealQueue\SQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода добавления в очередь: SQueue::enqueue();
 */
class SQueueEnqueueTest extends TestCase
{
    /**
     * Проверка добавления в очередь одного элемента
     *
     * @return void
     */
    #[Test] public function sQueueEnqueueOneNode(): void
    {
        $queue = new SQueue();

        $queue->enqueue('a');

        static::assertCount(1, $queue);
    }

    /**
     * Проверка добавления в очередь нескольких (5) элементов
     *
     * @return void
     */
    #[Test] public function sQueueEnqueue5Nodes(): void
    {
        $queue = new SQueue();

        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        static::assertCount(5, $queue);
    }
}
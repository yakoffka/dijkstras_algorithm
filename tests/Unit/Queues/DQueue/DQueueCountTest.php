<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Queues\DQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queues\DQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода подсчета количества элементов в очереди: DQueue::count();
 */
class DQueueCountTest extends TestCase
{
    /**
     * Проверка подсчета количества элементов в пустой очереди
     *
     * @return void
     */
    #[Test] public function dQueueCountOnEmpty(): void
    {
        $queue = new DQueue();

        $actual = $queue->count();

        static::assertEquals(0, $actual);
    }

    /**
     * Проверка подсчета количества элементов в очереди, содержащей один элемент
     *
     * @return void
     */
    #[Test] public function dQueueCountOnSingleNode(): void
    {
        $queue = new DQueue();
        $queue->enqueue('a');

        $actual = $queue->count();

        static::assertEquals(1, $actual);
    }

    /**
     * Проверка подсчета количества элементов в очереди, содержащей несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function dQueueCountOn5Nodes(): void
    {
        $queue = new DQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        $actual = $queue->count();

        static::assertEquals(5, $actual);
    }
}
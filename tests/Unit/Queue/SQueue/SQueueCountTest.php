<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Queue\SQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queue\SinglyLinkedRealQueue\SQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода подсчета количества элементов в очереди: SQueue::count();
 */
class SQueueCountTest extends TestCase
{
    /**
     * Проверка подсчета количества элементов в пустой очереди
     *
     * @return void
     */
    #[Test] public function sQueueCountOnEmpty(): void
    {
        $queue = new SQueue();

        $actual = $queue->count();

        static::assertEquals(0, $actual);
    }

    /**
     * Проверка подсчета количества элементов в очереди, содержащей один элемент
     *
     * @return void
     */
    #[Test] public function sQueueCountOnSingleNode(): void
    {
        $queue = new SQueue();
        $queue->enqueue('a');

        $actual = $queue->count();

        static::assertEquals(1, $actual);
    }

    /**
     * Проверка подсчета количества элементов в очереди, содержащей несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function sQueueCountOn5Nodes(): void
    {
        $queue = new SQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        $actual = $queue->count();

        static::assertEquals(5, $actual);
    }
}
<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Queue\DQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queue\DoublyLinkedRealQueue\DQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода строкового представления очереди: DQueue::show();
 */
class DQueueShowTest extends TestCase
{
    /**
     * Проверка строкового представления пустой очереди
     *
     * @return void
     */
    #[Test] public function dQueueCountOnEmpty(): void
    {
        $queue = new DQueue();

        $actual = $queue->show();

        static::assertEquals('', $actual);
    }

    /**
     * Проверка строкового представления очереди, содержащей один элемент
     *
     * @return void
     */
    #[Test] public function dQueueCountOnSingleNode(): void
    {
        $queue = new DQueue();
        $queue->enqueue('a');

        $actual = $queue->count();

        static::assertEquals('1', $actual);
    }

    /**
     * Проверка строкового представления очереди, содержащей несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function dQueueCountOn5Nodes(): void
    {
        $queue = new DQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        $actual = $queue->show();

        static::assertEquals('5 -> 4 -> 3 -> 2 -> 1', $actual);
    }
}
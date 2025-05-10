<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Queues\DQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queues\DQueue;
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
    #[Test] public function dQueueShowOnEmpty(): void
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
    #[Test] public function dQueueShowOnSingleNode(): void
    {
        $queue = new DQueue();
        $queue->enqueue('a');

        $actual = $queue->show();

        static::assertEquals('a', $actual);
    }

    /**
     * Проверка строкового представления очереди, содержащей несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function dQueueShowOn5Nodes(): void
    {
        $queue = new DQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        $actual = $queue->show();

        static::assertEquals('5 -> 4 -> 3 -> 2 -> 1', $actual);
    }
}
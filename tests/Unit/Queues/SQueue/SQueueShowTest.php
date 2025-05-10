<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Queues\SQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queues\SQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода строкового представления очереди: SQueue::show();
 */
class SQueueShowTest extends TestCase
{
    /**
     * Проверка строкового представления пустой очереди
     *
     * @return void
     */
    #[Test] public function sQueueShowOnEmpty(): void
    {
        $queue = new SQueue();

        $actual = $queue->show();

        static::assertEquals('', $actual);
    }

    /**
     * Проверка строкового представления очереди, содержащей один элемент
     *
     * @return void
     */
    #[Test] public function sQueueShowOnSingleNode(): void
    {
        $queue = new SQueue();
        $queue->enqueue('a');

        $actual = $queue->show();

        static::assertEquals('a', $actual);
    }

    /**
     * Проверка строкового представления очереди, содержащей несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function sQueueShowOn5Nodes(): void
    {
        $queue = new SQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        $actual = $queue->show();

        static::assertEquals('5 -> 4 -> 3 -> 2 -> 1', $actual);
    }
}
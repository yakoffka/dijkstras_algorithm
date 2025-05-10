<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Queues\DQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queues\DQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода "проверка на пустоту" очереди: DQueue::isEmpty();
 */
class DQueueIsEmptyTest extends TestCase
{
    /**
     * Проверка пустой очереди на пустоту
     *
     * @return void
     */
    #[Test] public function dQueueIsEmptyOnEmpty(): void
    {
        $queue = new DQueue();

        $actual = $queue->isEmpty();

        static::assertTrue($actual);
    }

    /**
     * Проверка на пустоту очереди, содержащей один элемент
     *
     * @return void
     */
    #[Test] public function dQueueIsEmptyOnSingleNode(): void
    {
        $queue = new DQueue();
        $queue->enqueue('a');

        $actual = $queue->isEmpty();

        static::assertFalse($actual);
    }

    /**
     * Проверка на пустоту очереди, содержащей несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function dQueueIsEmptyOn5Nodes(): void
    {
        $queue = new DQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        $actual = $queue->isEmpty();

        static::assertFalse($actual);
    }}
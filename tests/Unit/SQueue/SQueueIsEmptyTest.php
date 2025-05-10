<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\SQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\SinglyLinkedRealQueue\SQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода "проверка на пустоту" очереди: SQueue::isEmpty();
 */
class SQueueIsEmptyTest extends TestCase
{
    /**
     * Проверка пустой очереди на пустоту
     *
     * @return void
     */
    #[Test] public function sQueueIsEmptyOnEmpty(): void
    {
        $queue = new SQueue();

        $actual = $queue->isEmpty();

        static::assertTrue($actual);
    }

    /**
     * Проверка на пустоту очереди, содержащей один элемент
     *
     * @return void
     */
    #[Test] public function sQueueIsEmptyOnSingleNode(): void
    {
        $queue = new SQueue();
        $queue->enqueue('a');

        $actual = $queue->isEmpty();

        static::assertFalse($actual);
    }

    /**
     * Проверка на пустоту очереди, содержащей несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function sQueueIsEmptyOn5Nodes(): void
    {
        $queue = new SQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        $actual = $queue->isEmpty();

        static::assertFalse($actual);
    }}
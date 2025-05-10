<?php
declare(strict_types=1);

namespace Unit\Queues\DQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queues\DQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода DQueue::jsonSerialize();
 */
class DQueueJsonTest extends TestCase
{
    /**
     * Проверка метода jsonSerialize на пустой очереди
     *
     * @return void
     */
    #[Test] public function stackJsonOnEmpty(): void
    {
        $queue = new DQueue();

        $actual = $queue->jsonSerialize();

        static::assertEquals([], $actual);
    }

    /**
     * Проверка метода jsonSerialize на очереди, содержащей один элемент
     *
     * @return void
     */
    #[Test] public function stackJsonOnSingleNode(): void
    {
        $queue = new DQueue();
        $queue->enqueue('a');

        $actual = $queue->jsonSerialize();

        static::assertEquals([
            [
                'payload' => 'a',
                'prev' => null,
                'next' => null,
            ]
        ], $actual);
    }

    /**
     * Проверка метода jsonSerialize на очереди, содержащей несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function stackJsonOn5Nodes(): void
    {
        $queue = new DQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        $actual = $queue->jsonSerialize();

        static::assertEquals([
            [
                'payload' => '5',
                'prev' => '4',
                'next' => null,
            ],
            [
                'payload' => '4',
                'prev' => '3',
                'next' => '5',
            ],
            [
                'payload' => '3',
                'prev' => '2',
                'next' => '4',
            ],
            [
                'payload' => '2',
                'prev' => '1',
                'next' => '3',
            ],
            [
                'payload' => '1',
                'prev' => null,
                'next' => '2',
            ]
        ], $actual);
    }

    /**
     * Проверка метода jsonSerialize на очереди, содержащей несколько (5) элементов после удаления двух элементов
     *
     * @return void
     */
    #[Test] public function stackJsonOn3Nodes(): void
    {
        $queue = new DQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }
        $queue->dequeue();
        $queue->dequeue();

        $actual = $queue->jsonSerialize();

        static::assertEquals([
            [
                'payload' => '5',
                'prev' => '4',
                'next' => null,
            ],
            [
                'payload' => '4',
                'prev' => '3',
                'next' => '5',
            ],
            [
                'payload' => '3',
                'prev' => null,
                'next' => '4',
            ],
        ], $actual);
    }
}
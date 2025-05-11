<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Queues\SQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queues\SQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода SQueue::jsonSerialize();
 */
class SQueueJsonTest extends TestCase
{
    /**
     * Проверка метода jsonSerialize на пустой очереди
     *
     * @return void
     */
    #[Test] public function sQueueJsonOnEmpty(): void
    {
        $queue = new SQueue();

        $actual = $queue->jsonSerialize();

        static::assertEquals([], $actual);
    }

    /**
     * Проверка метода jsonSerialize на очереди, содержащей один элемент
     *
     * @return void
     */
    #[Test] public function sQueueJsonOnSingleNode(): void
    {
        $queue = new SQueue();
        $queue->enqueue('a');

        $actual = $queue->jsonSerialize();

        static::assertEquals([
            [
                'payload' => 'a',
                'link' => null,
            ]
        ], $actual);
    }

    /**
     * Проверка метода jsonSerialize на очереди, содержащей несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function sQueueJsonOn5Nodes(): void
    {
        $queue = new SQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }

        $actual = $queue->jsonSerialize();

        static::assertEquals([
            [
                'payload' => '5',
                'link' => '4',
            ],
            [
                'payload' => '4',
                'link' => '3',
            ],
            [
                'payload' => '3',
                'link' => '2',
            ],
            [
                'payload' => '2',
                'link' => '1',
            ],
            [
                'payload' => '1',
                'link' => null,
            ]
        ], $actual);
    }

    /**
     * Проверка метода jsonSerialize на очереди после частичного удаления элементов
     *
     * @return void
     */
    #[Test] public function sQueueJsonOnPartDequeues(): void
    {
        $queue = new SQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }
        $queue->dequeue();
        $queue->dequeue();

        $actual = $queue->jsonSerialize();

        static::assertEquals([
            [
                'payload' => '5',
                'link' => '4',
            ],
            [
                'payload' => '4',
                'link' => '3',
            ],
            [
                'payload' => '3',
                'link' => null,
            ]
        ], $actual);
    }

    /**
     * Проверка метода jsonSerialize на очереди после полного удаления элементов
     *
     * @return void
     */
    #[Test] public function sQueueJsonOnFullDequeues(): void
    {
        $queue = new SQueue();
        foreach (range(1, 5) as $i) {
            $queue->enqueue((string)$i);
        }
        foreach (range(1, 5) as $i) {
            $queue->dequeue();
        }

        $actual = $queue->jsonSerialize();

        static::assertEquals([], $actual);
    }
}
<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\DQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\DoublyLinkedRealQueue\DQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

class DQueuePushTest extends TestCase
{
    /**
     * @return void
     */
    #[Test] public function DQueuePushEmptySimple(): void
    {
        $queue = new DQueue();

        static::assertCount(0, $queue);
    }

    /**
     * @return void
     */
    #[Test] public function DQueuePushOneSimple(): void
    {
        $queue = new DQueue();

        $queue->push('a');

        static::assertCount(1, $queue);
    }

    /**
     * @return void
     */
    #[Test] public function DQueuePushRandSimple(): void
    {
        $queue = new DQueue();
        $counter = rand(1, 10);

        foreach (range(1, $counter) as $i) {
            $queue->push((string)$i);
        }

        static::assertCount($counter, $queue);
    }
}
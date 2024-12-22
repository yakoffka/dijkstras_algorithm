<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\SQueue;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\SinglyLinkedRealQueue\SQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

class SQueuePushTest extends TestCase
{
    /**
     * @return void
     */
    #[Test] public function sQueuePushEmptySimple(): void
    {
        $queue = new SQueue();

        static::assertCount(0, $queue);
    }

    /**
     * @return void
     */
    #[Test] public function sQueuePushOneSimple(): void
    {
        $queue = new SQueue();

        $queue->push('a');

        static::assertCount(1, $queue);
    }

    /**
     * @return void
     */
    #[Test] public function sQueuePushRandSimple(): void
    {
        $queue = new SQueue();
        $counter = rand(1, 10);

        foreach (range(1, $counter) as $i) {
            $queue->push((string)$i);
        }

        static::assertCount($counter, $queue);
    }
}
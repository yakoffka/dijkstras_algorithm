<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Stack;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\SinglyLinkedRealQueue\SQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

class StackPushTest extends TestCase
{
    /**
     * @return void
     */
    #[Test] public function sQueuePushEmptySimple(): void
    {
        $stack = new SQueue();

        static::assertCount(0, $stack);
    }

    /**
     * @return void
     */
    #[Test] public function sQueuePushOneSimple(): void
    {
        $stack = new SQueue();

        $stack->push('a');

        static::assertCount(1, $stack);
    }

    /**
     * @return void
     */
    #[Test] public function sQueuePushRandSimple(): void
    {
        $stack = new SQueue();
        $counter = rand(1, 10);

        foreach (range(1, $counter) as $i) {
            $stack->push((string)$i);
        }

        static::assertCount($counter, $stack);
    }
}
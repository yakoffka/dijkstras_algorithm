<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Stack;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Stack\Stack;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

class StackPushTest extends TestCase
{
    /**
     * @return void
     */
    #[Test] public function sQueuePushEmptySimple(): void
    {
        $stack = new Stack();

        static::assertCount(0, $stack);
    }

    /**
     * @return void
     */
    #[Test] public function sQueuePushOneSimple(): void
    {
        $stack = new Stack();

        $stack->push('a');

        static::assertCount(1, $stack);
    }

    /**
     * @return void
     */
    #[Test] public function sQueuePushRandSimple(): void
    {
        $stack = new Stack();
        $counter = rand(1, 10);

        foreach (range(1, $counter) as $i) {
            $stack->push((string)$i);
        }

        static::assertCount($counter, $stack);
    }
}
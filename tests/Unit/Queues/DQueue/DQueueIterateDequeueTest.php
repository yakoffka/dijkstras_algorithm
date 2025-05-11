<?php
declare(strict_types=1);

namespace Unit\Queues\DQueue;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queues\DQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода извлечения всех элементов очереди через генератор: DQueue::iterateDequeue();
 */
class DQueueIterateDequeueTest extends TestCase
{
    /**
     * Проверка метода извлечения всех элементов через генератор
     *
     * @param array $array
     * @return void
     */
    #[Test]
    #[DataProvider('arrayDataProvider')]
    public function dQueueDequeueOnEmpty(array $array): void
    {
        $queue = DQueue::fromArray($array);

        $iterator = $queue->iterateDequeue();

        static::assertEquals($array, iterator_to_array($iterator));
    }

    /**
     * @return array
     */
    public static function arrayDataProvider(): array
    {
        return [
            [[]],
            [['a']],
            [['a', 'b', 'c']],
            [['a', 'b', 'c', 'd', 'e', 'f']],
        ];
    }
}
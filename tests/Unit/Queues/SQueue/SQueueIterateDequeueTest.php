<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Queues\SQueue;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Queues\SQueue;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода извлечения всех элементов очереди через генератор: SQueue::iterateDequeue();
 */
class SQueueIterateDequeueTest extends TestCase
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
        $queue = SQueue::fromArray($array);

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
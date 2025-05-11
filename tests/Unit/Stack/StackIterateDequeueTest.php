<?php
declare(strict_types=1);

namespace Unit\Stack;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Stack\Stack;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода извлечения всех элементов списка через генератор: Stack::iteratePop();
 */
class StackIterateDequeueTest extends TestCase
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
        $queue = Stack::fromArray($array);

        $iterator = $queue->iteratePop();

        static::assertEquals(array_reverse($array), iterator_to_array($iterator));
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
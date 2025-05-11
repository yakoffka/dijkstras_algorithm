<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Tests\Unit\Stack;

use PHPUnit\Framework\Attributes\Test;
use Yakoffka\DijkstrasAlgorithm\Stack\Stack;
use Yakoffka\DijkstrasAlgorithm\Tests\TestCase;

/**
 * Тестирование метода Stack::jsonSerialize();
 */
class StackJsonTest extends TestCase
{
    /**
     * Проверка метода jsonSerialize на пустом стеке
     *
     * @return void
     */
    #[Test] public function stackJsonOnEmpty(): void
    {
        $stack = new Stack();

        $actual = $stack->jsonSerialize();

        static::assertEquals([], $actual);
    }

    /**
     * Проверка метода jsonSerialize на стеке, содержащем один элемент
     *
     * @return void
     */
    #[Test] public function stackJsonOnSingleNode(): void
    {
        $stack = new Stack();
        $stack->push('a');

        $actual = $stack->jsonSerialize();

        static::assertEquals([
            [
                'payload' => 'a',
                'link' => null,
            ]
        ], $actual);
    }

    /**
     * Проверка метода jsonSerialize на стеке, содержащем несколько (5) элементов
     *
     * @return void
     */
    #[Test] public function stackJsonOn5Nodes(): void
    {
        $stack = new Stack();
        foreach (range(1, 5) as $i) {
            $stack->push((string)$i);
        }

        $actual = $stack->jsonSerialize();

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
     * Проверка метода jsonSerialize на стеке после частичного удаления элементов
     *
     * @return void
     */
    #[Test] public function stackJsonOnPartPop(): void
    {
        $stack = new Stack();
        foreach (range(1, 5) as $i) {
            $stack->push((string)$i);
        }
        $stack->pop();
        $stack->pop();

        $actual = $stack->jsonSerialize();

        static::assertEquals([
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
     * Проверка метода jsonSerialize на стеке после полного удаления элементов
     *
     * @return void
     */
    #[Test] public function stackJsonOnFullPop(): void
    {
        $stack = new Stack();
        foreach (range(1, 5) as $i) {
            $stack->push((string)$i);
        }
        foreach (range(1, 5) as $i) {
            $stack->pop();
        }

        $actual = $stack->jsonSerialize();

        static::assertEquals([], $actual);
    }
}
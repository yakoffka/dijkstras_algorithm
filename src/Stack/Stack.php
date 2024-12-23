<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Stack;

use Countable;

/**
 * Стек (на основе односвязного списка) LIFO.
 * У Стека есть доступ только к последнему элементу.
 */
class Stack implements Countable
{
    private ?StackNode $last = null;

    /**
     * Добавление элемента в стек (в конец)
     *
     * @param string $payload
     */
    public function push(string $payload): void
    {
        $this->last = new StackNode($payload, $this->last);
    }

    /**
     * Получение последнего элемента стека без его извлечения
     *
     * @return string|null
     */
    public function peek(): ?string
    {
        return $this->last?->getPayload();
    }

    /**
     * Извлечение последнего элемента стека
     *
     * @return string|null
     */
    public function pop(): ?string
    {
        $result = $this->last?->getPayload();

        $this->last = $this->last?->getPrev();

        return $result;
    }

    /**
     * Отображение содержимого стека: от последнего к первому
     *
     * @return void
     */
    public function show(): void
    {
        $result = [];
        $node = $this->last;

        while ($node !== null) {
            $result[] = $node->getPayload();
            $node = $node->getPrev();
        }

        echo empty($result)
            ? 'stack is empty' . PHP_EOL
            : implode(' -> ', $result) . PHP_EOL;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        $count = 0;

        $node = $this->last;
        while ($node !== null) {
            $count ++;
            $node = $node->getPrev();
        }

        return $count;
    }
}
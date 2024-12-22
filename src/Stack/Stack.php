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
    private ?StackNode $lastNode = null;

    /**
     * Добавление элемента в стек (в конец)
     *
     * @param string $payload
     */
    public function push(string $payload): void
    {
        $this->lastNode = new StackNode($payload, $this->lastNode);
    }

    /**
     * Получение последнего элемента стека без его извлечения
     *
     * @return string|null
     */
    public function peek(): ?string
    {
        return $this->lastNode?->getPayload();
    }

    /**
     * Извлечение последнего элемента стека
     *
     * @return string|null
     */
    public function pop(): ?string
    {
        $result = $this->lastNode?->getPayload();

        $this->lastNode = $this->lastNode?->getPrev();

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
        $node = $this->lastNode;

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

        $node = $this->lastNode;
        while ($node !== null) {
            $count ++;
            $node = $node->getPrev();
        }

        return $count;
    }
}
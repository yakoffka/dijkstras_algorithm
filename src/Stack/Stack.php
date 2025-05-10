<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Stack;

use Countable;
use Yakoffka\DijkstrasAlgorithm\Primitives\SingleNode;

/**
 * Стек (на основе односвязного списка) LIFO.
 * У Стека есть доступ только к последнему элементу.
 */
class Stack implements Countable
{
    private ?SingleNode $last = null;

    /**
     * Добавление элемента в стек
     *
     * @param string $payload
     */
    public function push(string $payload): void
    {
        $this->last = new SingleNode($payload, $this->last);
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

        $this->last = $this->last?->getLink();

        return $result;
    }

    /**
     * Получение строкового представления стека: от последнего (верхнего) к первому (нижнему) элементу
     *
     * @return string
     */
    public function show(): string
    {
        $result = [];
        $node = $this->last;

        while ($node !== null) {
            $result[] = $node->getPayload();
            $node = $node->getLink();
        }

        return implode(' -> ', $result);
    }

    /**
     * Проверка на пустоту: возвращает true, если стек пуст, и false в противном случае
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->peek() === null;
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
            $node = $node->getLink();
        }

        return $count;
    }
}
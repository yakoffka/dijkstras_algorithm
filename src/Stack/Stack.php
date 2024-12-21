<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Stack;

/**
 * Стек (на основе односвязного списка)
 */
class Stack
{
    private ?StackNode $lastNode = null;

    /**
     * Добавление элемента в стек (в конец массива)
     *
     * @param string $payload
     */
    public function push(string $payload): void
    {
        echo PHP_EOL . "push $payload" . PHP_EOL;
        $this->lastNode = new StackNode($payload, $this->lastNode);
    }

    /**
     * Получение последнего элемента стека без его извлечения
     *
     * @return string|null
     */
    public function peek(): ?string
    {
        echo PHP_EOL . 'peek ' . ($this->lastNode?->getPayload() ?? 'null') . PHP_EOL;
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

        echo PHP_EOL . 'pop ' . ($result ?? 'null') . PHP_EOL;
        $this->lastNode = $this->lastNode?->getPrev();

        return $result;
    }

    /**
     * Отображение содержимого стека
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
}
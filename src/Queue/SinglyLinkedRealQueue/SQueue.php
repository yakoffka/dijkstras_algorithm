<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Queue\SinglyLinkedRealQueue;

use Countable;

/**
 * Очередь (на основе односвязного списка) FIFO.
 * У очереди есть доступ и к первому и к последнему элементу.
 */
class SQueue implements Countable
{
    private ?SQueueNode $first = null;
    private ?SQueueNode $last = null;

    /**
     * Добавление элемента в конец очереди
     *
     * При добавлении первого элемента в очередь он будет являться одновременно и последним, ссылка на предыдущий
     * узел не проставляется.
     *
     * @param string $payload
     */
    public function enqueue(string $payload): void
    {
        $this->last = new SQueueNode(payload: $payload, prev: $this->last);

        $this->first ??= $this->last;
    }

    /**
     * Получение первого элемента очереди без его извлечения
     *
     * @return string|null
     */
    public function peekFirst(): ?string
    {
        return $this->first?->getPayload();
    }

    /**
     * Получение последнего элемента очереди без его извлечения
     *
     * @return string|null
     */
    public function peekLast(): ?string
    {
        return $this->last?->getPayload();
    }

    /**
     * Извлечение первого элемента очереди
     *
     * @return string|null
     */
    public function dequeue(): ?string
    {
        $node = $this->first;

        if ($this->last === $node) {
            $this->last = null;

        } else {
            $this->first = $this->getNext($node);
            $this->first?->unsetPrev();
        }

        return $node?->getPayload();
    }

    /**
     * Проверка на пустоту: возвращает true, если очередь пуста, и false в противном случае
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->peekFirst() === null;
    }

    /**
     * Подсчет количества элементов в очереди
     *
     * @return int
     */
    public function count(): int
    {
        $count = 0;

        $node = $this->last;
        while ($node !== null) {
            $count++;
            $node = $node->getPrev();
        }

        return $count;
    }

    /**
     * Отображение содержимого очереди в строковом представлении: от последнего к первому ('n -> n-1 -> ... -> 2 -> 1')
     *
     * @return string
     */
    public function show(): string
    {
        $result = [];
        $current = $this->last;

        while ($current !== null) {
            $result[] = $current->getPayload();
            $current = $current->getPrev();
        }

        return implode(' -> ', $result);
    }

    /**
     * Динамическое получение следующего элемента очереди (в узле есть ссылка только на предыдущий)
     *
     * @param SQueueNode $current
     * @return SQueueNode|null
     */
    private function getNext(SQueueNode $current): ?SQueueNode
    {
        $node = $this->last;

        while ($node !== null && $node->getPrev() !== $current) {
            $node = $node->getPrev();
        }

        return $node;
    }
}
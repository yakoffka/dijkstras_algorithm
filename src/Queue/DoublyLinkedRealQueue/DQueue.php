<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Queue\DoublyLinkedRealQueue;

use Countable;
use JsonSerializable;

/**
 * Очередь на основе двусвязного списка
 */
class DQueue implements JsonSerializable, Countable
{
    private ?DQueueNode $first = null;
    private ?DQueueNode $last = null;

    /**
     * Добавление элемента в конец очереди
     *
     * При добавлении первого элемента в очередь он будет являться одновременно и последним, но ссылку на предыдущий
     * узел не проставляется.
     *
     * @param string $payload
     */
    public function enqueue(string $payload): void
    {
        $node = new DQueueNode(payload: $payload, prev: $this->last);
        $this->last?->setNext($node);
        $this->last = $node;

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
        if ($this->last === $this->first) {
            $this->last = null;
            $this->first = null;
        }

        $result = $node?->getPayload();

        $this->first = $node?->getNext();
        $this->first?->setPrev(null);

        return $result;
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
            $count ++;
            $node = $node->getPrev();
        }

        return $count;
    }

    /**
     * Отображение содержимого очереди: от последнего к первому
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
            ? 'queue is empty' . PHP_EOL
            : "{$this->last?->getPayload()}|"
            . implode(' -> ', $result)
            . "|{$this->first?->getPayload()}" . PHP_EOL;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $node = $this->last;

        while ($node !== null) {
            $result[] = $node;
            $node = $node->getPrev();
        }

        return array_map(static fn(DQueueNode $node) => $node->jsonSerialize(), $result ?? []);
    }
}
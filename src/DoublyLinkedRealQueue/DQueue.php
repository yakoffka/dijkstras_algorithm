<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\DoublyLinkedRealQueue;

use Countable;
use JsonSerializable;

/**
 * Очередь (на основе двусвязного списка) FIFO.
 * У очереди есть доступ и к первому и к последнему элементу.
 */
class DQueue implements JsonSerializable, Countable
{
    private ?DQueueNode $first = null;
    private ?DQueueNode $last = null;

    /**
     * Добавление элемента в очередь (в конец)
     *
     * При добавлении первого элемента в очередь он будет являться одновременно и последним, но ссылку на предыдущий
     * узел не проставляется.
     *
     * @param string $payload
     */
    public function push(string $payload): void
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
     * Получение последнего элемента очереди без его извлечения: кто последний?
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
    public function shift(): ?string
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

        return array_map(fn(DQueueNode $node) => $node->jsonSerialize(), $result ?? []);
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
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
    private ?DQueueNode $firstNode = null;
    private ?DQueueNode $lastNode = null;

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
        $node = new DQueueNode(payload: $payload, prev: $this->lastNode);
        $this->lastNode?->setNext($node);
        $this->lastNode = $node;

        $this->firstNode ??= $this->lastNode;
    }

    /**
     * Получение первого элемента очереди без его извлечения
     *
     * @return string|null
     */
    public function peekFirst(): ?string
    {
        return $this->firstNode?->getPayload();
    }

    /**
     * Получение последнего элемента очереди без его извлечения: кто последний?
     *
     * @return string|null
     */
    public function peekLast(): ?string
    {
        return $this->lastNode?->getPayload();
    }

    /**
     * Извлечение первого элемента очереди
     *
     * @return string|null
     */
    public function shift(): ?string
    {
        $node = $this->firstNode;
        if ($this->lastNode === $this->firstNode) {
            $this->lastNode = null;
            $this->firstNode = null;
        }

        $result = $node?->getPayload();

        $this->firstNode = $node?->getNext();
        $this->firstNode?->setPrev(null);

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
        $node = $this->lastNode;

        while ($node !== null) {
            $result[] = $node->getPayload();
            $node = $node->getPrev();
        }

        echo empty($result)
            ? 'queue is empty' . PHP_EOL
            : "{$this->lastNode?->getPayload()}|"
            . implode(' -> ', $result)
            . "|{$this->firstNode?->getPayload()}" . PHP_EOL;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $node = $this->lastNode;

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

        $node = $this->lastNode;
        while ($node !== null) {
            $count ++;
            $node = $node->getPrev();
        }

        return $count;
    }
}
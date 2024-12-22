<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\DoublyLinkedRealQueue;

use JsonSerializable;

/**
 * Очередь (на основе двусвязного списка) FIFO.
 * У очереди есть доступ и к первому и к последнему элементу.
 */
class Queue implements JsonSerializable
{
    private ?QueueNode $firstNode = null;
    private ?QueueNode $lastNode = null;

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
        echo PHP_EOL . "push $payload" . PHP_EOL;

        $node = new QueueNode(payload: $payload, prev: $this->lastNode);
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
        $firstPayload = $this->firstNode?->getPayload();
        echo PHP_EOL . 'peek first ' . ($firstPayload ?? 'null') . PHP_EOL;

        return $firstPayload;
    }

    /**
     * Получение последнего элемента очереди без его извлечения: кто последний?
     *
     * @return string|null
     */
    public function peekLast(): ?string
    {
        $lastPayload = $this->lastNode?->getPayload();
        echo PHP_EOL . 'peek last ' . ($lastPayload ?? 'null') . PHP_EOL;

        return $lastPayload;
    }

    /**
     * Извлечение первого элемента очереди
     *
     * @return string|null
     */
    public function shift(): ?string
    {
//        var_dump($this->firstNode->getNext()->getPayload());
//        die();

        $node = $this->firstNode;
        if ($this->lastNode === $this->firstNode) {
            $this->lastNode = null;
            $this->firstNode = null;
        }

        $result = $node?->getPayload();
        echo PHP_EOL . 'shift ' . ($result ?? 'null') . PHP_EOL;

        // echo __LINE__ . ': ' . json_encode($this->firstNode, JSON_THROW_ON_ERROR) . PHP_EOL;
        $this->firstNode = $node?->getNext();
        // echo __LINE__ . ': ' . json_encode($this->firstNode, JSON_THROW_ON_ERROR) . PHP_EOL;
        $this->firstNode?->setPrev(null);
        // echo __LINE__ . ': ' . json_encode($this->firstNode, JSON_THROW_ON_ERROR) . PHP_EOL;

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

        return array_map(fn(QueueNode $node) => $node->jsonSerialize(), $result ?? []);
    }
}
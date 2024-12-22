<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\SinglyLinkedRealQueue;

/**
 * Очередь (на основе односвязного списка) FIFO.
 * У очереди есть доступ и к первому и к последнему элементу.
 */
class Queue
{
    private ?QueueNode $firstNode = null;
    private ?QueueNode $lastNode = null;

    /**
     * Добавление элемента в очередь (в конец)
     *
     * При добавлении первого элемента в очередь он будет являться одновременно и последним, но ссылка на предыдущий
     * узел не проставляется.
     *
     * @param string $payload
     */
    public function push(string $payload): void
    {
        echo PHP_EOL . "push $payload" . PHP_EOL;

        $this->lastNode = new QueueNode(payload: $payload, prev: $this->lastNode);

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
        $firstNode = $this->firstNode;
        $result = $firstNode?->getPayload();
        echo PHP_EOL . 'shift ' . ($result ?? 'null') . PHP_EOL;

        if ($this->lastNode === $firstNode) {
            $this->lastNode = null;

        } else {
            $this->firstNode = $this->getNext($firstNode);
            $this->firstNode?->unsetPrev();
        }

        return $result;
    }

    /**
     * Отображение содержимого очереди: от первого к последнему
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
            : "{$this->lastNode->getPayload()}|"
            . implode(' -> ', $result)
            . "|{$this->firstNode->getPayload()}" . PHP_EOL;
    }

    /**
     * Динамическое получение следующего элемента очереди (в узле есть ссылка только на предыдущий)
     *
     * @param QueueNode $current
     * @return QueueNode|null
     */
    private function getNext(QueueNode $current): ?QueueNode
    {
        $node = $this->lastNode;

        while ($node !== null && $node->getPrev() !== $current) {
            $node = $node->getPrev();
        }

        return $node;
    }
}
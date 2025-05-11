<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Queues;

use Yakoffka\DijkstrasAlgorithm\Nodes\DoubleNode;

/**
 * Очередь на основе двусвязного списка
 */
class DQueue extends AbstractQueue
{
    protected ?DoubleNode $first = null;
    protected ?DoubleNode $last = null;

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
        $node = new DoubleNode(payload: $payload, prev: $this->last);
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
     * @return array
     */
    public function jsonSerialize(): array
    {
        $node = $this->last;

        while ($node !== null) {
            $result[] = $node;
            $node = $node->getPrev();
        }

        return array_map(static fn(DoubleNode $node) => $node->jsonSerialize(), $result ?? []);
    }
}
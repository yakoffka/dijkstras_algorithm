<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\SinglyLinkedRealQueue;

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
     * Добавление элемента в очередь (в конец)
     *
     * При добавлении первого элемента в очередь он будет являться одновременно и последним, но ссылка на предыдущий
     * узел не проставляется.
     *
     * @param string $payload
     */
    public function push(string $payload): void
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

        if ($this->last === $node) {
            $this->last = null;

        } else {
            $this->first = $this->getNext($node);
            $this->first?->unsetPrev();
        }

        return $node?->getPayload();
    }

    /**
     * Отображение содержимого очереди: от первого к последнему
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
            : "{$this->last->getPayload()}|"
            . implode(' -> ', $result)
            . "|{$this->first->getPayload()}" . PHP_EOL;
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
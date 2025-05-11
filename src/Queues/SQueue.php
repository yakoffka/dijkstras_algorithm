<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Queues;

use Yakoffka\DijkstrasAlgorithm\Nodes\SingleNode;

/**
 * Очередь на основе односвязного списка
 */
class SQueue extends AbstractQueue
{
    protected ?SingleNode $first = null;
    protected ?SingleNode $last = null;

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
        $this->last = new SingleNode(payload: $payload, link: $this->last);

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
            $this->first = null;

        } else {
            $this->first = $this->getNext($node);
            $this->first?->setLink(null);
        }

        return $node?->getPayload();
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
            $current = $current->getLink();
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
            $node = $node->getLink();
        }

        return array_map(static fn(SingleNode $node) => $node->jsonSerialize(), $result ?? []);
    }

    /**
     * Динамическое получение следующего элемента очереди (в узле есть ссылка только на предыдущий)
     *
     * @param SingleNode $current
     * @return SingleNode|null
     */
    private function getNext(SingleNode $current): ?SingleNode
    {
        $node = $this->last;

        while ($node !== null && $node->getLink() !== $current) {
            $node = $node->getLink();
        }

        return $node;
    }
}
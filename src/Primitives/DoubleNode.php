<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Primitives;

/**
 * Узел двусвязного списка
 */
class DoubleNode
{
    /**
     * @param string $payload полезная нагрузка узла
     * @param DoubleNode|null $prev ссылка на предыдущий узел
     * @param DoubleNode|null $next ссылка на следующий узел
     */
    public function __construct(private readonly string $payload, private ?self $prev, private ?self $next = null)
    {
    }

    /**
     * @return string
     */
    public function getPayload(): string
    {
        return $this->payload;
    }

    /**
     * @return DoubleNode|null
     */
    public function getPrev(): ?static
    {
        return $this->prev;
    }

    /**
     * @param DoubleNode|null $prev
     * @return $this
     */
    public function setPrev(?DoubleNode $prev): DoubleNode
    {
        $this->prev = $prev;
        return $this;
    }

    /**
     * @return DoubleNode|null
     */
    public function getNext(): ?DoubleNode
    {
        return $this->next;
    }

    /**
     * @param DoubleNode|null $next
     * @return void
     */
    public function setNext(?DoubleNode $next): void
    {
        $this->next = $next;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'payload' => $this->payload,
            'prev' => $this->prev?->payload,
            'next' => $this->next?->payload,
        ];
    }
}
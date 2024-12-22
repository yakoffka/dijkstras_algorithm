<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\DoublyLinkedRealQueue;

use JsonSerializable;

/**
 * Узел односвязной очереди. Должен уметь ответить на вопрос: а Вы за кем?
 */
class QueueNode implements JsonSerializable
{
    /**
     * @param string $payload полезная нагрузка узла
     * @param QueueNode|null $prev ссылка на предыдущий узел
     * @param QueueNode|null $next ссылка на следующий узел
     */
    public function __construct(readonly private string $payload, private ?self $prev, private ?self $next = null)
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
     * @return QueueNode|null
     */
    public function getPrev(): ?QueueNode
    {
        return $this->prev;
    }

    /**
     * @param QueueNode|null $prev
     * @return void
     */
    public function setPrev(?QueueNode $prev): void
    {
        $this->prev = $prev;
    }

    /**
     * @return QueueNode|null
     */
    public function getNext(): ?QueueNode
    {
        return $this->next;
    }

    /**
     * @param QueueNode|null $next
     * @return void
     */
    public function setNext(?QueueNode $next): void
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
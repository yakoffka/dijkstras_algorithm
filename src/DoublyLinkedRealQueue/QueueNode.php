<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\DoublyLinkedRealQueue;

use JsonSerializable;
use Yakoffka\DijkstrasAlgorithm\Primitives\DoubleNode;

/**
 * Узел односвязной очереди
 */
class QueueNode extends DoubleNode implements JsonSerializable
{
    /**
     * @param string $payload полезная нагрузка узла
     * @param QueueNode|null $prev ссылка на предыдущий узел
     * @param QueueNode|null $next ссылка на следующий узел
     */
    public function __construct(readonly private string $payload, private ?self $prev, private ?self $next = null)
    {
        parent::__construct(payload: $this->payload, prev: $this->prev, next: $this->next);
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
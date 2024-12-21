<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Stack;

/**
 * Узел односвязного списка
 */
readonly class StackNode
{
    /**
     * @param string $payload полезная нагрузка узла
     * @param QueueNode|null $prev ссылка на предыдущий узел
     */
    public function __construct(private string $payload, private ?self $prev)
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
}
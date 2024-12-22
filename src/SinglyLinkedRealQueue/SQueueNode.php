<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\SinglyLinkedRealQueue;

use Yakoffka\DijkstrasAlgorithm\Primitives\DoubleNode;

/**
 * Узел односвязной очереди
 */
class SQueueNode extends DoubleNode
{
    /**
     * @param string $payload полезная нагрузка узла
     * @param SQueueNode|null $prev ссылка на предыдущий узел
     */
    public function __construct(readonly private string $payload, private ?self $prev)
    {
        parent::__construct(payload: $this->payload, prev: $this->prev);
    }

    /**
     * @return void
     */
    public function unsetPrev(): void
    {
        $this->prev = null;
    }
}
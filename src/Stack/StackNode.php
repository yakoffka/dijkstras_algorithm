<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Stack;

use Yakoffka\DijkstrasAlgorithm\Primitives\DoubleNode;

/**
 * Узел односвязного списка
 */
class StackNode extends DoubleNode
{
    /**
     * @param string $payload полезная нагрузка узла
     * @param StackNode|null $prev ссылка на предыдущий узел
     */
    public function __construct(private readonly string $payload, private readonly ?self $prev)
    {
        parent::__construct(payload: $this->payload, prev: $this->prev);
    }
}
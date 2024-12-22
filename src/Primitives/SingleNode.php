<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Primitives;

/**
 * Узел односвязного списка
 */
class SingleNode extends DoubleNode
{
    /**
     * @param string $payload полезная нагрузка узла
     * @param SingleNode|null $prev ссылка на предыдущий узел
     */
    public function __construct(private readonly string $payload, private readonly ?self $prev)
    {
        parent::__construct(payload: $this->payload, prev: $this->prev);
    }

    /**
     * @return string
     */
    public function getPayload(): string
    {
        return parent::getPayload();
    }

    /**
     * @return $this|null
     */
    public function getPrev(): ?static
    {
        return parent::getPrev();
    }
}
<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Primitives;

use JsonSerializable;

/**
 * Узел односвязного списка
 */
class SingleNode implements JsonSerializable
{
    /**
     * @param string $payload полезная нагрузка узла
     * @param SingleNode|null $link ссылка на предыдущий или следующий узел
     */
    public function __construct(private readonly string $payload, private ?self $link = null)
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
     * @return SingleNode|null
     */
    public function getLink(): ?SingleNode
    {
        return $this->link;
    }

    /**
     * @param SingleNode|null $link
     * @return void
     */
    public function setLink(?SingleNode $link): void
    {
        $this->link = $link;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'payload' => $this->payload,
            'link' => $this->link?->payload,
        ];
    }
}
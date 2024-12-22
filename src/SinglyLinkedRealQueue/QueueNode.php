<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\SinglyLinkedRealQueue;

/**
 * Узел односвязной очереди. Должен уметь ответить на вопрос: а Вы за кем?
 */
class QueueNode
{
    /**
     * @param string $payload полезная нагрузка узла
     * @param QueueNode|null $prev ссылка на предыдущий узел
     */
    public function __construct(readonly private string $payload, private ?self $prev)
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
     * @return void
     */
    public function unsetPrev(): void
    {
        $this->prev = null;
    }
}
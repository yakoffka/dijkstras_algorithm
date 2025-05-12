<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Graph;

/**
 * Обрабатываемый узел графа
 */
class HandlingNode
{
    /**
     * @param bool $isHandled признак завершения обработки узла
     * @param int|null $weight минимальное расстояние от предыдущего узла
     * @param string|null $prevNode предыдущий узел
     */
    public function __construct(
        private bool    $isHandled = false,
        private ?int    $weight = null,
        private ?string $prevNode = null,
    )
    {
    }

    /**
     * Инициализация класса
     *
     * @return self
     */
    public static function init(): self
    {
        return new self();
    }

    /**
     * Отметка узла "обработан": расстояния до всех смежных узлов посчитаны
     *
     * @return void
     */
    public function markHandled(): void
    {
        $this->isHandled = true;
    }

    /**
     * Установка нового минимального расстояния от предыдущего узла $weight и наименования предыдущего узла $prevNode
     *
     * @param int $weight
     * @param string $prevNode
     * @return void
     */
    public function resetWeight(int $weight, string $prevNode): void
    {
        if ($this->weight === null || $this->weight > $weight) {
            $this->weight = $weight;
            $this->prevNode = $prevNode;
        }
    }

    /**
     * Получение признака завершения обработки узла
     *
     * @return bool
     */
    public function isHandled(): bool
    {
        return $this->isHandled;
    }

    /**
     * Получение минимального расстояния от предыдущего узла
     *
     * @return int|null
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * Получение наименования предыдущего узла.
     * NOTE: В момент запроса значение не должно быть null!
     *
     * @return string
     */
    public function getPrevNode(): string
    {
        return $this->prevNode;
    }
}
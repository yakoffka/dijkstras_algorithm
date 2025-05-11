<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Interfaces;

interface Sequencable
{
    /**
     * Проверка наличия узла с нагрузкой в последовательности
     *
     * @param string $node_payload значение нагрузки узла
     * @return bool
     */
    public function contains(string $node_payload): bool;
}
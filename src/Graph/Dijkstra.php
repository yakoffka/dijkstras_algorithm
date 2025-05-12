<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Graph;

/**
 * Вспомогательный класс для нахождения минимальных расстояний от одного из узлов графа до остальных узлов
 */
class Dijkstra
{
    private const TEMPLATE = 'Кратчайший путь в графе между узлами "%s" и "%s" лежит через %s и составляет %d единиц.';

    /**
     * @var array<HandlingNode> Ассоциативный массив обрабатываемых узлов с их наименованиями в качестве ключей
     */
    private array $nodes = [];

    /**
     * @param Graph $graph
     */
    public function __construct(readonly public Graph $graph)
    {
    }

    /**
     * @param Graph $graph
     * @return self
     */
    public static function fromGraph(Graph $graph): self
    {
        return new self($graph);
    }

    /**
     * Получение кратчайшего пути из узла $from в узел $to
     *
     * @param string $from
     * @param string $to
     * @return string
     */
    public function getShortestPath(string $from, string $to): string
    {
        $this->init($from);

        while (($current = $this->getNearestUnhandledNode()) !== null) {
            $this->setWeightIncidentNodes($current, $this->nodes[$current]->getWeight());
            $this->nodes[$current]->markHandled();
        }

        // @todo проверить завершенность обработки всех узлов!?

        $weight = $this->nodes[$to]->getWeight();

        $answer = sprintf(self::TEMPLATE, $from, $to, $this->restorePath($from, $to), $weight);
        echo $answer . PHP_EOL;

        return $answer;
    }

    /**
     * Инициализация поиска
     *
     * @param string $from
     * @return void
     */
    private function init(string $from): void
    {
        foreach ($this->graph->getNodes() as $node) {
            $this->nodes[$node] = HandlingNode::init();
        }

        $current = $this->nodes[$from];
        $current->resetWeight(0, $from);
    }

    /**
     * Получение ближайшего необработанного узла (необработанный узел с минимальным значением $weight)
     *
     * @return string|null
     */
    private function getNearestUnhandledNode(): ?string
    {
        foreach ($this->nodes as $node_name => $node) {
            if ($node->isHandled() || $node->getWeight() === null) {
                continue;
            }

            $weights[$node_name] = $node->getWeight();
        }

        return empty($weights)
            ? null
            : array_search(min($weights), $weights, true);
    }

    /**
     * Установка расстояний до смежных для узла $node узлов
     *
     * @param string $node
     * @param int $current_wight
     * @return void
     */
    private function setWeightIncidentNodes(string $node, int $current_wight): void
    {
        foreach ($this->graph->getIncidentNodes($node) as $incident_node) {
            $delta_weight = $this->graph->getAdjacencyList()[$node][$incident_node];
            $a = $this->nodes[$incident_node];
            $a->resetWeight($current_wight + $delta_weight, $node);
        }
    }

    /**
     * Метод, восстанавливающий полученный наикратчайший путь
     * Получение суммарного пути от начальной к конечной точки
     *
     * @param string $from
     * @param string $to
     * @return string
     */
    private function restorePath(string $from, string $to): string
    {
//        $reverse_path = [];
//
//        while ($to !== $from) {
//            $handled = $this->nodes[$to];
//            $to = $handled->getPrevNode();
//            $reverse_path[] = $to;
//        }
//
//        return implode(', ', array_reverse($reverse_path));
        $reverse_path = [];

        while (true) {
            $handled = $this->nodes[$to];
            $to = $handled->getPrevNode();

            if ($to === $from) {
                break;
            }

            $reverse_path[] = $to;
        }

        return implode(', ', array_reverse($reverse_path));
    }
}
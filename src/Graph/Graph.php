<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Graph;

use Countable;
use JsonSerializable;
use RuntimeException;
use Yakoffka\DijkstrasAlgorithm\Interfaces\Sequencable;

/**
 * Реализация неориентированного графа на основе матрицы смежности
 */
class Graph implements JsonSerializable, Countable, Sequencable
{
    /**
     * @var array Список смежности — один из способов представления графа в виде коллекции списков узлов.
     * Каждому узлу графа соответствует список, состоящий из «соседей» этого узла.
     */
    private array $adjacencyList = [];

    /**
     * @param array $nodes
     * @param array $edges
     * @return self
     * @todo протестировать!
     */
    public static function from(array $nodes, array $edges): self
    {
        $graph = new self();

        foreach ($nodes as $node) {
            $graph->addNode($node);
        }

        foreach ($edges as $edge) {
            $graph->addEdge(...$edge);
        }

        return $graph;
    }

    /**
     * Добавление узла графа
     *
     * @param string $node
     * @return Graph
     */
    public function addNode(string $node): self
    {
        $this->adjacencyList[$node] = [];

        return $this;
    }

    /**
     * Добавление ребра графа
     *
     * @param string $node1
     * @param string $node2
     * @param int $weight
     * @return Graph
     */
    public function addEdge(string $node1, string $node2, int $weight): self
    {
        $this->checkEdgeNodes($node1, $node2);

        $this->adjacencyList[$node1][$node2] = $weight;
        $this->adjacencyList[$node2][$node1] = $weight;

        return $this;
    }

    /**
     * Получение массива всех узлов графа
     *
     * @return array
     */
    public function getNodes(): array
    {
        return iterator_to_array($this->iterateNodes());
    }

    /**
     * Получение списка смежности графа
     *
     * @return array
     */
    public function getAdjacencyList(): array
    {
        return $this->adjacencyList;
    }

    /**
     * Получение генератора всех узлов графа
     *
     * @return iterable
     */
    public function iterateNodes(): iterable
    {
        foreach ($this->adjacencyList as $node => $_weights) {
            yield $node;
        }
    }

    /**
     * Получение всех ребер графа
     *
     * @return iterable
     */
    public function getEdges(): iterable
    {
        foreach ($this->adjacencyList as $node1 => $weights) {
            foreach ($weights as $node2 => $weight) {
                yield "$node1-$node2: $weight";
            }
        }
    }

    /**
     * Получение всех ребер узла $node
     *
     * @param string $node
     * @return iterable
     */
    public function getNodeEdges(string $node): iterable
    {
        foreach ($this->adjacencyList[$node] as $node2 => $weight) {
            yield $node2 => $weight;
        }
    }

    /**
     * Получение всех соседних (смежных) узлов указанного узла $node
     *
     * @param string $node
     * @return iterable
     */
    public function getIncidentNodes(string $node): iterable
    {
        foreach ($this->adjacencyList[$node] as $node2 => $_weight) {
            yield $node2;
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->adjacencyList;
    }

    /**
     * Получение количества узлов
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->adjacencyList);
    }

    /**
     * Проверка наличия узла в графе
     *
     * @param string $node_payload
     * @return bool
     */
    public function contains(string $node_payload): bool
    {
        foreach ($this?->iterateNodes() as $node) {

            if ($node_payload === $node) {
                return true;
            }
        }

        return false;
    }

    /**
     * Валидация узлов добавляемого ребра: выброс исключения при отсутствии в матрице хотя-бы одного узла
     *
     * @param string $node1
     * @param string $node2
     * @return void
     */
    private function checkEdgeNodes(string $node1, string $node2): void
    {
        if(!$this->contains($node1)) {
            throw new RuntimeException("Node '$node1' does not exist");
        }

        if(!$this->contains($node2)) {
            throw new RuntimeException("Node '$node2' does not exist");
        }
    }
}
<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Graph;

use Countable;
use JsonSerializable;
use RuntimeException;

/**
 * Реализация неориентированного графа на основе матрицы смежности
 */
class Graph implements JsonSerializable, Countable
{
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
     * @var array матрица смежности вершин графа
     */
    private array $edges = [];

    /**
     * Добавление вершины графа
     *
     * @param string $node
     * @return Graph
     */
    public function addNode(string $node): self
    {
        $this->edges[$node] = [];

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

        $this->edges[$node1][$node2] = $weight;
        $this->edges[$node2][$node1] = $weight;

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
     * Получение генератора всех узлов графа
     *
     * @return iterable
     */
    public function iterateNodes(): iterable
    {
        foreach ($this->edges as $node => $_weights) {
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
        foreach ($this->edges as $node1 => $weights) {
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
        foreach ($this->edges[$node] as $node2 => $weight) {
            yield $node2 => $weight;
        }
    }

    /**
     * Получение всех соседних (смежных) узлов указанного узла $node
     *
     * @param string $node
     * @return iterable
     */
    public function getNeighboursNodes(string $node): iterable
    {
        foreach ($this->edges[$node] as $node2 => $_weight) {
            yield $node2;
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->edges;
    }

    /**
     * Получение количества узлов
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->edges);
    }

    /**
     * Проверка наличия узла в графе
     *
     * @param string $verifiable
     * @return bool
     */
    private function containNode(string $verifiable): bool
    {
        foreach ($this?->iterateNodes() as $node) {

            if ($verifiable === $node) {
                return true;
            }
        }

        return false;
    }

    /**
     * Валидация вершин добавляемого ребра: выброс исключения при отсутствии в матрице хотя-бы одной вершины
     *
     * @param string $node1
     * @param string $node2
     * @return void
     */
    private function checkEdgeNodes(string $node1, string $node2): void
    {
        if(!$this->containNode($node1)) {
            throw new RuntimeException("Node '$node1' does not exist");
        }

        if(!$this->containNode($node2)) {
            throw new RuntimeException("Node '$node2' does not exist");
        }
    }
}
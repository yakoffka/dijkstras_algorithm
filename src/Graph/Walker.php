<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Graph;

use RuntimeException;
use Yakoffka\DijkstrasAlgorithm\Queues\SQueue;
use Yakoffka\DijkstrasAlgorithm\Stack\Stack;
use Yakoffka\DijkstrasAlgorithm\Tests\Unit\Graph\Traits\Graph64Trait;

/**
 * Вспомогательный класс для обхода графа
 */
class Walker
{
    /**
     * @var array пройденный путь
     */
    private array $path = [];

    /**
     * @param Graph $graph
     */
    public function __construct(readonly private Graph $graph)
    {
    }

    /**
     * Добавление вершины в путь
     *
     * @param string $node
     * @return void
     */
    public function addToPath(string $node): void
    {
        $this->path[] = $node;
    }

    /**
     * @return array
     */
    public function getPath(): array
    {
        return $this->path;
    }

    /**
     * Обход всех вершин графа в глубину с использованием стека (Depth First Search)
     *
     * @param string $node вершина начала обхода графа
     * @return void
     */
    public function walkDept(string $node): void
    {
        $this->checkNodeExist($node);

        $stack = Stack::fromArray([$node]);

        foreach ($stack->iteratePop() as $current) {
            $this->addToPath($current);

            foreach ($this->graph->getNeighboursNodes($current) as $neighbour) {
                if (!$this->pathContain($neighbour) && !$stack->contains($neighbour)) {
                    $stack->push($neighbour);
                }

                Graph64Trait::showWalk64graph($this->path, $stack);
            }
        }
    }

    /**
     * Обход всех вершин графа в ширину с использованием очереди
     * BFS, или Breadth First Search
     *
     * @param string $node вершина начала обхода графа
     * @return void
     */
    public function walkBreadth(string $node): void
    {
        $this->checkNodeExist($node);

        $queue = SQueue::fromArray([$node]);

        foreach ($queue->iterateDequeue() as $current) {
            $this->addToPath($current);
            foreach ($this->graph->getNeighboursNodes($current) as $neighbour) {
                if (!$this->pathContain($neighbour) && !$queue->contains($neighbour)) {
                    $queue->enqueue($neighbour);
                }
            }

            Graph64Trait::showWalk64graph($this->path, $queue);
        }
    }

    /**
     * Проверка наличия узла в графе
     *
     * @param string $verifiable
     * @return void
     */
    private function checkNodeExist(string $verifiable): void
    {
        foreach ($this->graph?->iterateNodes() as $node) {
            if ($verifiable === $node) {
                return;
            }
        }

        throw new RuntimeException("Node '$verifiable' does not exist");
    }

    /**
     * Проверка наличия узла в пройденном пути
     *
     * @param string $node узел, наличие которого проверяется в пройденном пути
     * @return bool
     */
    public function pathContain(string $node): bool
    {
        return in_array($node, $this->path, true);
    }
}
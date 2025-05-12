<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Graph;

use RuntimeException;
use Yakoffka\DijkstrasAlgorithm\Queues\SQueue;
use Yakoffka\DijkstrasAlgorithm\Stack\Stack;

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
     * Добавление узла в пройденный путь
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
     * Обход всех узлов графа в глубину с использованием стека (Depth First Search)
     *
     * @param string $node узел начала обхода графа
     * @return void
     */
    public function walkDept(string $node): void
    {
        $this->checkNodeExist($node);

        $stack = Stack::fromArray([$node]);

        foreach ($stack->iteratePop() as $current) {
            $this->addToPath($current);

            foreach ($this->graph->getIncidentNodes($current) as $neighbour) {
                if (!$this->pathContain($neighbour) && !$stack->contains($neighbour)) {
                    $stack->push($neighbour);
                }
            }
        }
    }

    /**
     * Обход всех узлов графа в ширину с использованием очереди (Breadth First Search)
     *
     * @param string $node узел начала обхода графа
     * @return void
     */
    public function walkBreadth(string $node): void
    {
        $this->checkNodeExist($node);

        $queue = SQueue::fromArray([$node]);

        foreach ($queue->iterateDequeue() as $current) {
            $this->addToPath($current);
            foreach ($this->graph->getIncidentNodes($current) as $neighbour) {
                if (!$this->pathContain($neighbour) && !$queue->contains($neighbour)) {
                    $queue->enqueue($neighbour);
                }
            }
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
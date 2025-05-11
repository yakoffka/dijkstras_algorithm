<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Queues;

use Countable;
use JsonSerializable;
use Yakoffka\DijkstrasAlgorithm\Interfaces\Sequencable;
use Yakoffka\DijkstrasAlgorithm\Nodes\DoubleNode;
use Yakoffka\DijkstrasAlgorithm\Nodes\SingleNode;

/**
 * Абстрактный класс для вынесения общих методов очередей на основе одно- и двусвязных списков
 */
abstract class AbstractQueue implements JsonSerializable, Countable, Sequencable
{
    /**
     * @param array<string> $array
     * @return self
     * @todo протестировать!
     */
    public static function fromArray(array $array): static
    {
        $stack = new static();

        foreach ($array as $item) {
            $stack->enqueue($item);
        }

        return $stack;
    }

    /**
     * Добавление элемента в конец очереди
     *
     * При добавлении первого элемента в очередь он будет являться одновременно и последним, но ссылку на предыдущий
     * узел не проставляется.
     *
     * @param string $payload
     */
    abstract public function enqueue(string $payload): void;

    /**
     * Получение первого элемента очереди без его извлечения
     *
     * @return string|null
     */
    abstract public function peekFirst(): ?string;

    /**
     * Получение последнего элемента очереди без его извлечения
     *
     * @return string|null
     */
    abstract public function peekLast(): ?string;

    /**
     * Извлечение первого элемента очереди
     *
     * @return string|null
     */
    abstract public function dequeue(): ?string;

    /**
     * Обход всех элементов с помощью генератора
     *
     * @return iterable
     */
    public function iterate(): iterable
    {
        /** @var SingleNode|DoubleNode $current */
        $current = $this->last;

        while ($current !== null) {
            yield $current;
            $current = $current::class === SingleNode::class
                ? $current->getLink()
                : $current->getPrev();
        }
    }

    /**
     * Извлечение всех элементов с помощью генератора
     *
     * @return iterable
     * @todo протестировать!
     */
    public function iterateDequeue(): iterable
    {
        while (!$this->isEmpty()) {
            yield $this->dequeue();
        }
    }

    /**
     * Проверка на пустоту: возвращает true, если очередь пуста, и false в противном случае
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->peekFirst() === null;
    }

    /**
     * Получение количества элементов
     *
     * @return int
     */
    public function count(): int
    {
        return count(iterator_to_array($this->iterate()));
    }

    /**
     * Проверка наличия узла в очереди
     *
     * @param string $node_payload
     * @return bool
     */
    public function contains(string $node_payload): bool
    {
        /** @var SingleNode|DoubleNode $node */
        foreach ($this->iterate() as $node) {
            if ($node_payload === $node->getPayload()) {
                return true;
            }
        }

        return false;
    }
}
<?php
declare(strict_types=1);

namespace Yakoffka\DijkstrasAlgorithm\Stack;

use Countable;
use InvalidArgumentException;
use JsonSerializable;
use Yakoffka\DijkstrasAlgorithm\Nodes\SingleNode;

/**
 * Стек (на основе односвязного списка) LIFO.
 * У Стека есть доступ только к последнему элементу.
 */
class Stack implements JsonSerializable, Countable
{
    private ?SingleNode $last = null;

    /**
     * @param array<string> $array
     * @return self
     * @todo протестировать!
     */
    public static function fromArray(array $array): self
    {
        $stack = new self();

        foreach ($array as $item) {
            // if(!is_string($item)) {
            //     throw new InvalidArgumentException('Stack item must be a string.');
            // }
            $stack->push($item);
        }

        return $stack;
    }

    /**
     * Добавление элемента в стек
     *
     * @param string $payload
     */
    public function push(string $payload): void
    {
        $this->last = new SingleNode($payload, $this->last);
    }

    /**
     * Получение последнего элемента стека без его извлечения
     *
     * @return string|null
     */
    public function peek(): ?string
    {
        return $this->last?->getPayload();
    }

    /**
     * Извлечение последнего элемента стека
     *
     * @return string|null
     */
    public function pop(): ?string
    {
        $result = $this->last?->getPayload();

        $this->last = $this->last?->getLink();

        return $result;
    }

    /**
     * Проверка на пустоту: возвращает true, если стек пуст, и false в противном случае
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->peek() === null;
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
     * Обход всех элементов с помощью генератора
     *
     * @return iterable
     * @todo протестировать!
     */
    public function iterate(): iterable
    {
        $node = $this->last;
        while ($node !== null) {
            yield $node;
            $node = $node->getLink();
        }
    }

    /**
     * Извлечение всех элементов с помощью генератора
     *
     * @return iterable
     * @todo протестировать!
     */
    public function iteratePop(): iterable
    {
        while (!$this->isEmpty()) {
            yield $this->pop();
        }
    }

    /**
     * Получение строкового представления стека: от последнего (верхнего) к первому (нижнему) элементу
     *
     * @return string
     */
    public function show(): string
    {
        $result = [];
        $node = $this->last;

        while ($node !== null) {
            $result[] = $node->getPayload();
            $node = $node->getLink();
        }

        return implode(' -> ', $result);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $node = $this->last;

        while ($node !== null) {
            $result[] = $node;
            $node = $node->getLink();
        }

        return array_map(static fn(SingleNode $node) => $node->jsonSerialize(), $result ?? []);
    }

    /**
     * Проверка наличия узла в стеке
     *
     * @param string $verifiable
     * @return bool
     */
    public function contain(string $verifiable): bool
    {
        /** @var SingleNode $node */
        foreach ($this->iterate() as $node) {
            if ($verifiable === $node->getPayload()) {
                return true;
            }
        }

        return false;
    }
}
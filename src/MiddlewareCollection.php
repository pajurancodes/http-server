<?php

namespace PajuranCodes\Http\Server;

use function count;
use function array_pop;
use function array_shift;
use function array_unshift;
use function array_key_exists;
use Psr\Http\Server\MiddlewareInterface;
use PajuranCodes\Http\Server\MiddlewareCollectionInterface;

/**
 * A collection of middlewares.
 *
 * @author pajurancodes
 */
class MiddlewareCollection implements MiddlewareCollectionInterface {

    /**
     * A list of middlewares.
     *
     * @var MiddlewareInterface[]
     */
    private array $middlewares = [];

    /**
     * @inheritDoc
     */
    public function get(int|string $key): ?MiddlewareInterface {
        return $this->exists($key) ? $this->middlewares[$key] : null;
    }

    /**
     * @inheritDoc
     */
    public function set(int|string $key, MiddlewareInterface $middleware): static {
        $this->middlewares[$key] = $middleware;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function push(MiddlewareInterface $middleware): static {
        $this->middlewares[] = $middleware;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function pop(): ?MiddlewareInterface {
        return array_pop($this->middlewares);
    }

    /**
     * @inheritDoc
     */
    public function shift(): ?MiddlewareInterface {
        return array_shift($this->middlewares);
    }

    /**
     * @inheritDoc
     */
    public function unshift(MiddlewareInterface $middleware): static {
        array_unshift($this->middlewares, $middleware);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function remove(int|string $key): static {
        if ($this->exists($key)) {
            unset($this->middlewares[$key]);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function exists(int|string $key): bool {
        return array_key_exists($key, $this->middlewares);
    }

    /**
     * @inheritDoc
     */
    public function all(): array {
        return $this->middlewares;
    }

    /**
     * @inheritDoc
     */
    public function clear(): static {
        $this->middlewares = [];
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isEmpty(): bool {
        return !($this->count() > 0);
    }

    /**
     * @inheritDoc
     */
    public function count(): int {
        return count($this->middlewares);
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): \Traversable {
        return new \ArrayIterator($this->middlewares);
    }

}

<?php

namespace PajuranCodes\Http\Server;

use Psr\Http\Server\MiddlewareInterface;

/**
 * An interface to a collection of middlewares.
 *
 * @author pajurancodes
 */
interface MiddlewareCollectionInterface extends \Countable, \IteratorAggregate {

    /**
     * Get a middleware from the collection.
     * 
     * @param int|string $key A key.
     * @return MiddlewareInterface|null The found middleware or null.
     */
    public function get(int|string $key): ?MiddlewareInterface;

    /**
     * Set a middleware in the collection.
     * 
     * @param int|string $key A key.
     * @param MiddlewareInterface $middleware A middleware.
     * @return static
     */
    public function set(int|string $key, MiddlewareInterface $middleware): static;

    /**
     * Push a middleware onto the end of the collection.
     * 
     * @param MiddlewareInterface $middleware A middleware.
     * @return static
     */
    public function push(MiddlewareInterface $middleware): static;

    /**
     * Pop and return the last middleware in the collection.
     * 
     * The collection will be shortened by one element.
     * 
     * @return MiddlewareInterface|null The last middleware, or null if the collection is empty.
     */
    public function pop(): ?MiddlewareInterface;

    /**
     * Shift a middleware off the beginning of the collection.
     * 
     * @return MiddlewareInterface|null The shifted middleware, or null if the collection is empty.
     */
    public function shift(): ?MiddlewareInterface;

    /**
     * Prepend a middleware to the beginning of the collection.
     * 
     * @param MiddlewareInterface $middleware A middleware.
     * @return static
     */
    public function unshift(MiddlewareInterface $middleware): static;

    /**
     * Remove a middleware from the collection.
     * 
     * @param int|string $key A key.
     * @return static
     */
    public function remove(int|string $key): static;

    /**
     * Check if a middleware exists in the collection.
     * 
     * @param int|string $key A key.
     * @return bool True if the specified key exists, or false otherwise.
     */
    public function exists(int|string $key): bool;

    /**
     * Get all middlewares from the collection.
     * 
     * @return MiddlewareInterface[] All middlewares in the collection.
     */
    public function all(): array;

    /**
     * Remove all middlewares from the collection.
     * 
     * @return static
     */
    public function clear(): static;

    /**
     * Check if the collection is empty.
     * 
     * @return bool True if the collection is empty, or false otherwise.
     */
    public function isEmpty(): bool;

    /**
     * Count the middlewares in the collection.
     *
     * @return int Number of middlewares in the collection.
     */
    public function count(): int;

    /**
     * Get an iterator to iterate through the collection.
     *
     * @return \Traversable The middlewares iterator.
     */
    public function getIterator(): \Traversable;
}

<?php

namespace PajuranCodes\Http\Server;

use Psr\Http\Message\{
    ResponseInterface,
    ServerRequestInterface,
};
use Psr\Http\Server\RequestHandlerInterface;
use PajuranCodes\Http\Server\MiddlewareCollectionInterface;

/**
 * A queue of middlewares.
 * 
 * This request handler processes each middleware 
 * in the provided middleware collection.
 *
 * @author pajurancodes
 */
class MiddlewareQueue implements RequestHandlerInterface {

    /**
     * 
     * @param MiddlewareCollectionInterface $middlewareCollection A collection of middlewares.
     * @param RequestHandlerInterface $fallbackHandler A request handler used as fallback.
     */
    public function __construct(
        private readonly MiddlewareCollectionInterface $middlewareCollection,
        private readonly RequestHandlerInterface $fallbackHandler
    ) {
        
    }

    /**
     * Handles a request and produces a response.
     * 
     * This method processes the middlewares of the 
     * middlewares collection in the FIFO order.
     * 
     * @param ServerRequestInterface $request A server request.
     * @return ResponseInterface The response to the current request.
     */
    public function handle(ServerRequestInterface $request): ResponseInterface {
        /*
         * If no (more) middlewares exist, the request 
         * handler used as fallback is handled.
         */
        if ($this->middlewareCollection->isEmpty()) {
            return $this->fallbackHandler->handle($request);
        }

        /*
         * Pull the first middleware from the middleware collection (FIFO).
         * The middleware collection will then be shortened by one element.
         */
        $middleware = $this->middlewareCollection->shift();

        // Process the pulled middleware.
        return $middleware->process($request, $this);
    }

}

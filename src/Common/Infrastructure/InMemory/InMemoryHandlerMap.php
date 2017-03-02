<?php
/**
 * This file is part of the Common package.
 *
 * (c) Andrzej Kostrzewa <com.kontakt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Common\Infrastructure\InMemory;

use Common\Application\CommandBus\CommandHandlerMap;

final class InMemoryHandlerMap implements CommandHandlerMap
{
    /**
     * @var array
     */
    private $handlers;

    /**
     * InMemoryHandlerMap constructor.
     */
    public function __construct()
    {
        $this->handlers = [];
    }

    /**
     * @param string $commandClass
     * @param        $handler
     */
    public function register(string $commandClass, $handler) : void
    {
        $this->handlers[$commandClass] = $handler;
    }

    /**
     * @param string $commandClass
     *
     * @return mixed
     */
    public function getHandlerFor(string $commandClass)
    {
        return $this->handlers[$commandClass];
    }
}

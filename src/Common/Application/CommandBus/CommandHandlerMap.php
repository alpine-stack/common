<?php
/**
 * This file is part of the Common package.
 *
 * (c) Andrzej Kostrzewa <bok.comstudio@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Common\Application\CommandBus;

interface CommandHandlerMap
{
    /**
     * @param string $commandClass
     * @param        $handler
     */
    public function register(string $commandClass, $handler) : void;

    /**
     * @param string $commandClass
     *
     * @return mixed
     */
    public function getHandlerFor(string $commandClass);
}

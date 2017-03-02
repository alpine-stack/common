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

namespace Common\Application\Command;

use Common\Application\ServiceLocator;

interface Extension
{
    /**
     * @param Command $command
     *
     * @return bool
     */
    public function expands(Command $command) : bool;

    /**
     * @param Command        $command
     * @param ServiceLocator $serviceLocator
     */
    public function pre(Command $command, ServiceLocator $serviceLocator) : void;

    /**
     * @param Command        $command
     * @param ServiceLocator $serviceLocator
     */
    public function post(Command $command, ServiceLocator $serviceLocator) : void;

    /**
     * @param Command        $command
     * @param \Exception     $e
     * @param ServiceLocator $serviceLocator
     */
    public function catchException(Command $command, \Exception $e, ServiceLocator $serviceLocator) : void;
}

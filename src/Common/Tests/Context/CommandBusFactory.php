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

namespace Common\Tests\Context;

use Common\Application\CommandBus;

interface CommandBusFactory
{
    /**
     * @param array $handlers
     * @param array $commandExtension
     *
     * @return CommandBus
     */
    public function create(array $handlers = [], array $commandExtension = []) : CommandBus;
}

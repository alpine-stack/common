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

namespace Common\Application;

use Common\Application\Command\Command;

interface CommandBus
{
    /**
     * @param Command $command
     */
    public function handle(Command $command) : void;
}

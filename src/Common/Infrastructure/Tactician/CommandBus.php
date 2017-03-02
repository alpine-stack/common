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

namespace Common\Infrastructure\Tactician;

use League\Tactician\CommandBus as Tactician;
use Common\Application\Command\Command;

final class CommandBus implements \Common\Application\CommandBus
{
    /**
     * @var Tactician
     */
    private $commandBus;

    /**
     * CommandBus constructor.
     *
     * @param Tactician $commandBus
     */
    public function __construct(Tactician $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command) : void
    {
        $this->commandBus->handle($command);
    }
}

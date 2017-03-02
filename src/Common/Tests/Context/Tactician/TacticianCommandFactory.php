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

namespace Common\Tests\Context\Tactician;

use Common\Application\Command\ExtensionRegistry;
use Common\Tests\Context\CommandBusFactory;
use Common\Infrastructure\InMemory\InMemoryServiceLocator;
use Common\Infrastructure\Tactician\CommandBus;
use League\Tactician\CommandBus as TacticianCommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;

final class TacticianCommandFactory implements CommandBusFactory
{
    /**
     * @param array $handlers
     * @param array $commandExtension
     *
     * @return \Common\Application\CommandBus
     */
    public function create(array $handlers = [], array $commandExtension = []) : \Common\Application\CommandBus
    {
        $commandHandlerMiddleware = new CommandHandlerMiddleware(
            new ClassNameExtractor(),
            new InMemoryLocator($handlers),
            new HandleInflector()
        );

        $serviceLocator    = new InMemoryServiceLocator();
        $extensionRegistry = new ExtensionRegistry($serviceLocator);

        foreach ($commandExtension as $extension) {
            $extensionRegistry->register($extension);
        }

        return new CommandBus(new TacticianCommandBus([
            $commandHandlerMiddleware
        ]));
    }
}

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

namespace Common\Application\Extension;

use Common\Application\Command\ExtensionRegistry;
use Common\Application\Exception\NotFoundException;
use Common\Application\Exception\ServiceContainer\ServiceNotFoundException;
use Common\Application\Extension;
use Common\Application\Extension\Command\TransactionExtension;
use Common\Application\ServiceContainer;
use Common\Application\ServiceLocator;
use Common\Application\Services;
use Common\Infrastructure\InMemory\InMemoryHandlerMap;

final class CoreExtension implements Extension
{
    /**
     * @var string
     */
    private $storageServiceId;

    /**
     * CoreExtension constructor.
     *
     * @param string $storageServiceId
     */
    public function __construct(string $storageServiceId)
    {
        $this->storageServiceId = $storageServiceId;
    }

    public function dependsOn() : array
    {
        return [];
    }

    /**
     * Used to register services in ServiceContainer
     *
     * @param ServiceContainer $serviceContainer
     *
     * @throws ServiceNotFoundException
     */
    public function build(ServiceContainer $serviceContainer) : void
    {
        if (!$serviceContainer->definitionExists(Services::KERNEL_SERVICE_LOCATOR)) {
            throw ServiceNotFoundException::withId(Services::KERNEL_SERVICE_LOCATOR);
        }

        $this->registerCommandServices($serviceContainer);
    }

    /**
     * @param ServiceContainer $serviceContainer
     */
    private function registerCommandServices(ServiceContainer $serviceContainer) : void
    {
        $serviceContainer->register(Services::KERNEL_COMMAND_EXTENSION_REGISTRY, new ServiceContainer\Definition(
            ExtensionRegistry::class,
            new ServiceContainer\ArgumentCollection(
                [new ServiceContainer\ArgumentService(Services::KERNEL_SERVICE_LOCATOR)]
            )
        ));

        $serviceContainer->register(
            Services::KERNEL_COMMAND_HANDLER_MAP,
            new ServiceContainer\Definition(
                InMemoryHandlerMap::class
            )
        );
    }

    /**
     * Executed immediately after initialization of ServiceLocator
     * it's the first place where CommandExtensions can be registered.
     *
     * @param ServiceLocator $serviceLocator
     *
     * @throws ServiceNotFoundException
     * @throws NotFoundException
     */
    public function boot(ServiceLocator $serviceLocator) : void
    {
        if (!$serviceLocator->has(Services::KERNEL_TRANSACTION_FACTORY)) {
            throw ServiceNotFoundException::withId(Services::KERNEL_TRANSACTION_FACTORY);
        }

        $serviceLocator->get(Services::KERNEL_COMMAND_EXTENSION_REGISTRY)
            ->register(new TransactionExtension($serviceLocator->get(Services::KERNEL_TRANSACTION_FACTORY)), -1024);
    }
}

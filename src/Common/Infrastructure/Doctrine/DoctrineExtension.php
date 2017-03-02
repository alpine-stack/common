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

namespace Common\Infrastructure\Doctrine;

use Common\Application\Exception\ServiceContainer\ServiceNotFoundException;
use Common\Application\Extension;
use Common\Application\ServiceContainer;
use Common\Application\ServiceLocator;
use Common\Application\Services;
use Common\Infrastructure\Doctrine\ORM\Application\Transaction\ORMFactory;

final class DoctrineExtension implements Extension
{
    /**
     * @var string
     */
    private $entityManagerServiceId;

    /**
     * @param string $entityManagerServiceId
     */
    public function __construct(string $entityManagerServiceId)
    {
        $this->entityManagerServiceId = $entityManagerServiceId;
    }

    /**
     * @return array
     */
    public function dependsOn() : array
    {
        return [
            Extension\CoreExtension::class
        ];
    }

    /**
     * @param ServiceContainer $serviceContainer
     *
     * @throws ServiceNotFoundException
     */
    public function build(ServiceContainer $serviceContainer) : void
    {
        $serviceContainer->register(
            Services::KERNEL_TRANSACTION_FACTORY,
            new ServiceContainer\Definition(
                ORMFactory::class,
                [
                    new ServiceContainer\ArgumentService($this->entityManagerServiceId)
                ]
            )
        );
    }

    /**
     * @param ServiceLocator $serviceLocator
     */
    public function boot(ServiceLocator $serviceLocator) : void
    {
    }
}

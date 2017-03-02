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

namespace Common\Application\Extension\Command;

use Common\Application\Command\Command;
use Common\Application\Command\Extension;
use Common\Application\ServiceLocator;
use Common\Application\Transaction\Factory;
use Common\Application\Transaction\Transaction;

final class TransactionExtension implements Extension
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * @var Transaction
     */
    private $transaction;

    /**
     * TransactionExtension constructor.
     *
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param Command $command
     *
     * @return bool
     */
    public function expands(Command $command) : bool
    {
        return true;
    }

    /**
     * @param Command        $command
     * @param ServiceLocator $serviceLocator
     */
    public function pre(Command $command, ServiceLocator $serviceLocator) : void
    {
        $this->transaction = $this->factory->open();
    }

    /**
     * @param Command        $command
     * @param ServiceLocator $serviceLocator
     */
    public function post(Command $command, ServiceLocator $serviceLocator) : void
    {
        $this->transaction->commit();
    }

    /**
     * @param Command        $command
     * @param \Exception     $e
     * @param ServiceLocator $serviceLocator
     *
     * @throws \Exception
     */
    public function catchException(Command $command, \Exception $e, ServiceLocator $serviceLocator) : void
    {
        $this->transaction->rollback();

        throw $e;
    }
}

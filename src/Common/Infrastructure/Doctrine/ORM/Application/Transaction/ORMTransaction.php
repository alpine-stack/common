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

namespace Common\Infrastructure\Doctrine\ORM\Application\Transaction;

use Common\Application\Transaction\Transaction;
use Doctrine\ORM\EntityManager;

final class ORMTransaction implements Transaction
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * ORMTransaction constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function commit() : void
    {
        $this->entityManager->flush();
        $this->entityManager->commit();
    }

    public function rollback() : void
    {
        $this->entityManager->rollback();
    }
}

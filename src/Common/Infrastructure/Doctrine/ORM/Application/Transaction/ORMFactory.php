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

namespace Common\Infrastructure\Doctrine\ORM\Application\Transaction;

use Common\Application\Transaction\Factory;
use Common\Application\Transaction\Transaction;
use Doctrine\ORM\EntityManager;

final class ORMFactory implements Factory
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * ORMFactory constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return Transaction
     */
    public function open() : Transaction
    {
        $this->entityManager->beginTransaction();

        return new ORMTransaction($this->entityManager);
    }
}

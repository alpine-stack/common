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

namespace Common\Infrastructure\InMemory\Transaction;

use Common\Application\Transaction\Transaction;

final class InMemoryTransaction implements Transaction
{
    public function commit() : void
    {
        // do nothing, everything happens in memory
    }

    public function rollback() : void
    {
        throw new \RuntimeException('InMemoryTransaction does not supports rollbacks');
    }
}

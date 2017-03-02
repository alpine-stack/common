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

namespace Common\Infrastructure\InMemory;

use Common\Application\Exception\NotFoundException;
use Common\Application\ServiceLocator;

final class InMemoryServiceLocator implements ServiceLocator
{
    /**
     * @param string $id
     *
     * @return mixed
     * @throws NotFoundException
     */
    public function get(string $id)
    {
        throw NotFoundException::serviceNotFound($id);
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function has(string $id) : bool
    {
        return false;
    }
}

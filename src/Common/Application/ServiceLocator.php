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

use Common\Application\Exception\NotFoundException;

interface ServiceLocator
{
    /**
     * @param string $id
     *
     * @return mixed
     * @throws NotFoundException
     */
    public function get(string $id);

    /**
     * @param string $id
     *
     * @return bool
     */
    public function has(string $id) : bool;
}

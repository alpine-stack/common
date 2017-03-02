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

namespace Common\Domain\Event;

use Common\Domain\Exception\UnknownEventException;

interface Listener
{
    /**
     * @param string $eventJson
     *
     * @throws UnknownEventException
     */
    public function on(string $eventJson) : void;
}

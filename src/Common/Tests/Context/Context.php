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

namespace Common\Tests\Context;

use Common\Application\CommandBus;

interface Context
{
    /**
     * @return CommandBus
     */
    public function commandBus() : CommandBus;
}

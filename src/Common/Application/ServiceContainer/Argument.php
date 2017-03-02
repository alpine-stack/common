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

namespace Common\Application\ServiceContainer;

interface Argument
{
    /**
     * @return array
     */
    public function value() : array;

    /**
     * @param Argument $argument
     */
    public function addArgument(Argument $argument) : void;
}

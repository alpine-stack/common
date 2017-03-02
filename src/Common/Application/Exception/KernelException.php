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

namespace Common\Application\Exception;

class KernelException extends Exception
{
    /**
     * @param string $extensionClass
     *
     * @return KernelException
     * @throws KernelException
     */
    public static function missingExtension(string $extensionClass) : KernelException
    {
        throw new self(sprintf("Extension \"%s\" is missing, can't build service container.", $extensionClass));
    }

    /**
     * @return KernelException
     * @throws KernelException
     */
    public static function notBuilt() : KernelException
    {
        throw new self("Kernel wasn't built yet, can't boot.");
    }
}

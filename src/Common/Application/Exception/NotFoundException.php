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

namespace Common\Application\Exception;

class NotFoundException extends Exception
{
    /**
     * @param string $id
     *
     * @return NotFoundException
     */
    public static function serviceNotFound(string $id) : NotFoundException
    {
        return new self(sprintf('Service with id "%s" does not exists.', $id));
    }
}

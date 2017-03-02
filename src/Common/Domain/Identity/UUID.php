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

namespace Common\Domain\Identity;

use Common\Domain\Exception\InvalidUUIDFormatException;
use Ramsey\Uuid\Uuid as BaseUUID;

class UUID
{
    /**
     * @var string
     */
    protected $uuid;

    /**
     * UUID constructor.
     *
     * @param string $uuid
     *
     * @throws InvalidUUIDFormatException
     */
    public function __construct(string $uuid)
    {
        $pattern = '/' . BaseUUID::VALID_PATTERN . '/';

        if (!preg_match($pattern, (string)$uuid)) {
            throw new InvalidUUIDFormatException();
        }

        $this->uuid = (string)$uuid;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string)$this->uuid;
    }

    /**
     * @param UUID $uuid
     *
     * @return bool
     */
    public function isEqual(UUID $uuid) : bool
    {
        return (string)$uuid === $this->uuid;
    }
}

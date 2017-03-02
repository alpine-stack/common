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

namespace Common\Application\Command;

trait CommandSerialize
{
    /**
     * @return string
     */
    final public function serialize() : string
    {
        return serialize(get_object_vars($this));
    }

    /**
     * @param $serialized
     *
     * @return CommandSerialize
     */
    final public function unserialize($serialized) : CommandSerialize
    {
        $data = unserialize($serialized);
        /** @var array $data */
        foreach ($data as $field => $value) {
            $this->$field = $value;
        }

        return $this;
    }
}

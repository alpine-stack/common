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

use Common\Domain\Event\Event;
use Common\Domain\Event\Listener;

interface EventLog
{
    /**
     * @param Event $event
     */
    public function log(Event $event) : void;

    /**
     * @param string   $eventName
     * @param Listener $listener
     */
    public function subscribeFor(string $eventName, Listener $listener) : void;
}

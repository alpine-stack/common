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

class Services
{
    const KERNEL_COMMAND_EXTENSION_REGISTRY = 'common.command.extension_registry';

    const KERNEL_COMMAND_HANDLER_MAP = 'common.command.handler_map';

    const KERNEL_SERVICE_LOCATOR = 'common.service.locator';

    const KERNEL_TRANSACTION_FACTORY = 'common.transaction.factory';
}

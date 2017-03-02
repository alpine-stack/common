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

namespace Common\Application\Command;

use Common\Application\ServiceLocator;

final class ExtensionRegistry
{
    const EXTENSION_KEY = 'extension';

    const EXTENSION_PRIORITY_KEY = 'priority';

    /**
     * @var Extension[]
     */
    private $extensions;

    /**
     * @var ServiceLocator
     */
    private $serviceLocator;

    /**
     * @param ServiceLocator $serviceLocator
     */
    public function __construct(ServiceLocator $serviceLocator)
    {
        $this->extensions = [];
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @param Extension $commandExtension
     * @param int       $priority
     */
    public function register(Extension $commandExtension, int $priority = 0) : void
    {
        $this->extensions[] = [self::EXTENSION_KEY => $commandExtension, self::EXTENSION_PRIORITY_KEY => $priority];
        if (count($this->extensions) > 1) {
            uasort($this->extensions, function ($itemA, $itemB) {
                return $itemA[self::EXTENSION_PRIORITY_KEY] <=> $itemB[self::EXTENSION_PRIORITY_KEY];
            });
        }
    }

    /**
     * @param Command $command
     */
    public function pre(Command $command) : void
    {
        foreach ($this->extensions as $extensionItem) {
            /** @var Extension $extension */
            $extension = $extensionItem[self::EXTENSION_KEY];
            if ($extension->expands($command)) {
                $extension->pre($command, $this->serviceLocator);
            }
        }
    }

    /**
     * @param Command $command
     */
    public function post(Command $command) : void
    {
        foreach ($this->extensions as $extensionItem) {
            /** @var Extension $extension */
            $extension = $extensionItem[self::EXTENSION_KEY];
            if ($extension->expands($command)) {
                $extension->post($command, $this->serviceLocator);
            }
        }
    }

    /**
     * @param Command    $command
     * @param \Exception $exception
     */
    public function passException(Command $command, \Exception $exception) : void
    {
        foreach ($this->extensions as $extensionItem) {
            /** @var Extension $extension */
            $extension = $extensionItem[self::EXTENSION_KEY];
            if ($extension->expands($command)) {
                $extension->catchException($command, $exception, $this->serviceLocator);
            }
        }
    }
}

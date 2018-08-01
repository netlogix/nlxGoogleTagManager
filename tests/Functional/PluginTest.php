<?php

namespace sdGoogleTagManager\Tests;

use sdGoogleTagManager\sdGoogleTagManager as Plugin;
use Shopware\Components\Test\Plugin\TestCase;

class PluginTest extends TestCase
{
    protected static $ensureLoadedPlugins = [
        'sdGoogleTagManager' => []
    ];

    public function testCanCreateInstance()
    {
        /** @var Plugin $plugin */
        $plugin = Shopware()->Container()->get('kernel')->getPlugins()['sdGoogleTagManager'];

        $this->assertInstanceOf(Plugin::class, $plugin);
    }
}

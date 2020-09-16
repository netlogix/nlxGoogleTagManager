<?php

namespace nlxGoogleTagManager\Tests;

use nlxGoogleTagManager\nlxGoogleTagManager as Plugin;
use Shopware\Components\Test\Plugin\TestCase;

class PluginTest extends TestCase
{
    protected static $ensureLoadedPlugins = [
        'nlxGoogleTagManager' => []
    ];

    public function testCanCreateInstance()
    {
        /** @var Plugin $plugin */
        $plugin = Shopware()->Container()->get('kernel')->getPlugins()['nlxGoogleTagManager'];

        $this->assertInstanceOf(Plugin::class, $plugin);
    }
}

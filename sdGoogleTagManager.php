<?php

namespace sdGoogleTagManager;

use Shopware\Components\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Shopware-Plugin sdGoogleTagManager.
 */
class sdGoogleTagManager extends Plugin
{

    /**
    * @param ContainerBuilder $container
    */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('sdgoogletagmanager.plugin_dir', $this->getPath());
        parent::build($container);
    }
}

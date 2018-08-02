<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace sdGoogleTagManager\Services;

use Shopware\Components\Plugin\CachedConfigReader;

class Config implements ConfigInterface
{
    /**
     * Pluginname (extendable, in static context)
     */
    const PLUGIN_NAME = 'sdGoogleTagManager';

    /** @var array */
    protected $config;

    public function __construct(CachedConfigReader $configReader)
    {
        $this->config = $configReader->getByPluginName(static::PLUGIN_NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $key, string $value)
    {
        $this->config[$key] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key)
    {
        return $this->config[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Gets the google tag manager id from config
     *
     * @return bool
     */
    public function getGoogleTagManagerTrackingId()
    {
        return $this->get('sdGoogleTagManagerTrackingId');
    }

    /**
     * Checks if remarketing is enabled in config
     *
     * @return mixed
     */
    public function isRemarketingEnabled()
    {
        return $this->get('sdGoogleTagManagerRemarketingEnabled');
    }
}

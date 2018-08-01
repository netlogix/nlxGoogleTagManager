<?php

namespace sdGoogleTagManager\Services;

use Shopware\Components\Plugin\CachedConfigReader;

class Config implements ConfigInterface
{

    /**
     * Pluginname (extendable, in static context)
     */
    const PLUGIN_NAME = 'sdGoogleTagManager';

    /**
     * @var array
     */
    protected $config;

    /**
     * @param CachedConfigReader $configReader
     */
    public function __construct(CachedConfigReader $configReader)
    {
        $this->config = $configReader->getByPluginName(static::PLUGIN_NAME);
    }

    /**
     * Sets a specific config value
     * @param string $key
     * @param string $value
     */
    public function set($key, $value)
    {
        $this->config[$key] = $value;
    }

    /**
     * Gets a specific config value by key
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->config[$key];
    }

    /**
     * Gets the complete config
     * @return array|mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Gets the google tag manager id from config
     * @return bool
     */
    public function getGoogleTagManagerTrackingId()
    {
        return $this->get('sdGoogleTagManagerTrackingId');
    }

    /**
     * Checks if remarketing is enabled in config
     * @return mixed
     */
    public function isRemarketingEnabled()
    {
        return $this->get('sdGoogleTagManagerRemarketingEnabled');
    }
}

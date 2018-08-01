<?php

namespace sdGoogleTagManager\Services;

/**
 * Interface ConfigInterface
 * @package sdGoogleTagManager\Services
 */
interface ConfigInterface
{
    /**
     * Gets the complete config
     */
    public function getConfig();

    /**
     * Gets a specific config value by key
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * Sets a specific config value
     * @param $key
     * @param $value
     */
    public function set($key, $value);
}

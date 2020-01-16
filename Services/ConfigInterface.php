<?php
declare(strict_types=1);

/*
 * Created by netlogix GmbH & Co. KG
 *
 * @copyright netlogix GmbH & Co. KG
 */

namespace sdGoogleTagManager\Services;

interface ConfigInterface
{
    /**
     * Gets the complete config
     */
    public function getConfig();

    /**
     * Gets a specific config value by key
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key);

    /**
     * Sets a specific config value
     *
     * @param string $key
     * @param string $value
     */
    public function set(string $key, string $value);
}

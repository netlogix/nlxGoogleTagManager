<?php
declare(strict_types=1);

/*
 * Created by netlogix GmbH & Co. KG
 *
 * @copyright netlogix GmbH & Co. KG
 */

namespace nlxGoogleTagManager\Services;

interface ConfigInterface
{
    /**
     * Gets the complete config
     *
     * @return mixed[]
     */
    public function getConfig(): array;

    /**
     * Gets a specific config value by key
     *
     * @return mixed
     */
    public function get(string $key);

    /**
     * Sets a specific config value
     */
    public function set(string $key, string $value): void;
}

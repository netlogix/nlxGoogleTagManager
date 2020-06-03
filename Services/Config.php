<?php
declare(strict_types=1);

/*
 * Created by netlogix GmbH & Co. KG
 *
 * @copyright netlogix GmbH & Co. KG
 */

namespace sdGoogleTagManager\Services;

use Shopware\Components\Plugin\CachedConfigReader;

class Config implements ConfigInterface
{
    /**
     * Pluginname (extendable, in static context)
     */
    const PLUGIN_NAME = 'sdGoogleTagManager';

    /** @var mixed[] */
    protected $config;

    public function __construct(CachedConfigReader $configReader)
    {
        $this->config = $configReader->getByPluginName(static::PLUGIN_NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $key, string $value): void
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
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * Gets the google tag manager id from config
     */
    public function getGoogleTagManagerTrackingId(): string
    {
        return $this->get('sdGoogleTagManagerTrackingId');
    }

    /**
     * Checks if remarketing is enabled in config
     */
    public function isRemarketingEnabled(): bool
    {
        return $this->get('sdGoogleTagManagerRemarketingEnabled');
    }

    public function useCookieConsentManager(): bool
    {
        return  $this->get('sdGoogleTagManagerUseCookieConsentManager');
    }
}

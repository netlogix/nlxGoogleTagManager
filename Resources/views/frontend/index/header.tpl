{extends file="parent:frontend/index/header.tpl"}

{block name="frontend_index_header_javascript_tracking"}
    {$smarty.block.parent}

    <script id="nlx-tag-manager-data">
        window.nlxGoogleTagManagerTrackingActive = {$nlxGoogleTagManagerTrackingActive};
        window.nlxGoogleTagManagerUsercentricsIntegrationEnabled = {$nlxGoogleTagManagerUsercentricsIntegrationEnabled};
        window.nlxGoogleTagManagerTrackingId = '{$nlxGoogleTagManagerTrackingId}';
        window.nlxGoogleAnalyticsMeasurementId = '{$nlxGoogleAnalyticsMeasurementId}';
        window.nlxGoogleAnalytics4MeasurementId = '{$nlxGoogleAnalytics4MeasurementId}';
        window.nlxGoogleTagManagerCookieName = '{$nlxGoogleTagManagerCookieName}';
        window.nlxGoogleTagManagerAnalyticsCookieName = '{$nlxGoogleTagManagerAnalyticsCookieName}';
        window.nlxGTMSnippets = {
            'googleTagManagerOptoutSuccess': '{s namespace="frontend/plugins/nlxGoogleTagManager" name="GoogleTagManagerOptoutSuccess"}{/s}',
            'googleAnalyticsOptoutSuccess': '{s namespace="frontend/plugins/nlxGoogleTagManager" name="GoogleAnalyticsOptoutSuccess"}{/s}'
        };

        var dataLayer = dataLayer || [];
    </script>

    <script>
        function googleTagManager() {
            (function(w,d,s,l,i){literal}{w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            }{/literal})(window,document,'script','dataLayer','{$nlxGoogleTagManagerTrackingId}');
        }
    </script>

    {if $nlxGoogleTagManagerTrackingActive}
        <!-- Google Tag Manager -->
        {block name="frontend_index_header_javascript_tracking_gtm"}{/block}

        <script>
            {if $nlxGoogleTagManagerUsercentricsIntegrationEnabled}
                window.addEventListener('ucEvent', (event) => {
                    if (event.detail['Google Tag Manager']) {
                        googleTagManager();
                    }
                });
            {else}
                googleTagManager();
            {/if}
        </script>

        <!-- End Google Tag Manager -->

        {include file="frontend/nlx_google_tag_manager/tags/remarketing.tpl"}

    {else}
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let cookiePermissionAcceptButton = document.getElementsByClassName('cookie-permission--accept-button')[0];
                if (cookiePermissionAcceptButton) {
                    cookiePermissionAcceptButton.addEventListener('click', function () {
                        googleTagManager();
                    });
                }
                let cookieConsentSaveButton = document.getElementsByClassName('cookie-consent--save-button')[0];
                if (cookieConsentSaveButton) {
                    cookieConsentSaveButton.addEventListener('click', function () {
                        let isGoogleTagManagerEnabled = $.getCookiePreference('nlxGoogleTagManager');

                        if (isGoogleTagManagerEnabled) {
                            googleTagManager();
                        }
                    });
                }
            });
        </script>
    {/if}
{/block}

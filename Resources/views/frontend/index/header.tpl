{extends file="parent:frontend/index/header.tpl"}

{block name="frontend_index_header_javascript_tracking"}
    {$smarty.block.parent}

    <script id="nlx-tag-manager-data">
        window.nlxGoogleTagManagerTrackingActive = {$nlxGoogleTagManagerTrackingActive};
        window.nlxGoogleTagManagerTrackingId = '{$nlxGoogleTagManagerTrackingId}';
        window.nlxGoogleAnalytics4MeasurementId = '{$nlxGoogleAnalytics4MeasurementId}';
        window.nlxGoogleTagManagerAnalyticsCookieName = '{$nlxGoogleTagManagerAnalyticsCookieName}';
        window.nlxGTMSnippets = {
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
            googleTagManager();
        </script>
        <!-- End Google Tag Manager -->

        {include file="frontend/nlx_google_tag_manager/tags/remarketing.tpl"}

    {else}
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.getElementsByClassName('cookie-permission--accept-button')[0].addEventListener('click', function () {
                    googleTagManager();
                });
            });
        </script>
    {/if}
{/block}

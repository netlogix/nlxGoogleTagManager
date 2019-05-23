{extends file="parent:frontend/index/header.tpl"}

{block name="frontend_index_header_javascript_tracking"}
    {$smarty.block.parent}

    {if $sdCookieStrategy >= 1 or $sdGoogleTagManagerIgnoreTrackingCookie}
        <!-- Google Tag Manager -->
        <script>
            window.isGTMLoaded = false;
            window.ignoreTrackingCookie = {$sdGoogleTagManagerIgnoreTrackingCookie};

            if (typeof dataLayer !== "undefined") {
                window.isGTMLoaded = true;
            }
            var dataLayer = dataLayer || [];
        </script>

        {block name="frontend_index_header_javascript_tracking_gtm"}{/block}

        <script>
            (function(w,d,s,l,i){literal}{w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                }{/literal})(window,document,'script','dataLayer','{$sdGoogleTagManagerTrackingId}');
        </script>
        <!-- End Google Tag Manager -->

        {include file="frontend/sd_google_tag_manager/tags/remarketing.tpl"}
    {/if}
{/block}

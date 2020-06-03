{if $sdGoogleTagManagerTrackingActive}
    <script>
        dataLayer.push({literal}{
            {/literal}{include file="frontend/sd_google_tag_manager/tags/enhanced.tpl"}{literal}
        }{/literal});
    </script>
{/if}

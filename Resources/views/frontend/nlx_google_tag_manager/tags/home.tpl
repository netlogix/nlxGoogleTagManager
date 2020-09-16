{if $nlxGoogleTagManagerTrackingActive}
    <script>
        dataLayer.push({literal}{
            {/literal}{include file="frontend/nlx_google_tag_manager/tags/enhanced.tpl"}{literal}
        }{/literal});
    </script>
{/if}

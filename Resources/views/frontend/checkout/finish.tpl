{extends file="parent:frontend/checkout/finish.tpl"}

{block name="frontend_index_header_javascript_tracking_gtm"}
    {if $sdCookieStrategy >= 1 or $sdGoogleTagManagerIgnoreTrackingCookie}
        {include file="frontend/sd_google_tag_manager/tags/purchase.tpl"}
    {/if}

    {$smarty.block.parent}
{/block}

{extends file="parent:frontend/home/index.tpl"}

{block name="frontend_index_header_javascript_tracking_gtm"}
    {if $sdCookieStrategy >= 1 or $sdGoogleTagManagerIgnoreTrackingCookie}
        {include file="frontend/sd_google_tag_manager/tags/home.tpl"}
    {/if}

    {$smarty.block.parent}
{/block}

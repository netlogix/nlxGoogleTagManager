{extends file="parent:frontend/listing/index.tpl"}

{block name="frontend_index_header_javascript_tracking_gtm"}
    {if $sdCookieStrategy >= 1}
        {include file="frontend/sd_google_tag_manager/tags/listing.tpl"}
    {/if}

    {$smarty.block.parent}
{/block}

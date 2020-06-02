{extends file="parent:frontend/checkout/finish.tpl"}

{block name="frontend_index_header_javascript_tracking_gtm"}
    {include file="frontend/sd_google_tag_manager/tags/purchase.tpl"}

    {$smarty.block.parent}
{/block}

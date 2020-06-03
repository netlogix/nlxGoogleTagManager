{extends file="parent:frontend/checkout/cart.tpl"}

{block name="frontend_index_header_javascript_tracking_gtm"}
    {include file="frontend/sd_google_tag_manager/tags/steps.tpl" step=0}

    {$smarty.block.parent}
{/block}

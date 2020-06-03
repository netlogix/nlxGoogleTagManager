{extends file="parent:frontend/custom/index.tpl"}

{block name="frontend_index_header_javascript_tracking_gtm"}
    {include file="frontend/sd_google_tag_manager/tags/home.tpl"}

    {$smarty.block.parent}
{/block}

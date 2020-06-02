{extends file="parent:frontend/detail/index.tpl"}

{block name="frontend_index_header_javascript_tracking_gtm"}
    {include file="frontend/sd_google_tag_manager/tags/detail.tpl"}

    {$smarty.block.parent}
{/block}

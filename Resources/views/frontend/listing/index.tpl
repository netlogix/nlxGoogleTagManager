{extends file="parent:frontend/listing/index.tpl"}

{block name="frontend_index_header_javascript_tracking_gtm"}
    {include file="frontend/sd_google_tag_manager/tags/listing.tpl"}

    {$smarty.block.parent}
{/block}

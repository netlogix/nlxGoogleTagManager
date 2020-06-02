{extends file="parent:frontend/listing/listing_ajax.tpl"}

{block name="frontend_listing_list_inline_ajax"}
    {include file="frontend/sd_google_tag_manager/tags/listing.tpl"}

    {$smarty.block.parent}
{/block}

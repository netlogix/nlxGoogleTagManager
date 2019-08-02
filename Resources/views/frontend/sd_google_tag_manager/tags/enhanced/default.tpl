{if $sdCookieStrategy >= 1 or $sdGoogleTagManagerIgnoreTrackingCookie}
    {literal}
        // Page Data (included on all Pages)
        // @todo: pageTitle for every page in shop
        'pageTitle': "{/literal}{strip}{if $sBreadcrumb}{foreach from=$sBreadcrumb|array_reverse item=breadcrumb}{$breadcrumb.name} | {/foreach}{/if}{{config name=sShopname}|escapeHtml}{/strip}{literal}",
        'pageCategory': "{/literal}{{controllerName|lower}}{literal}",
        'pageCategoryID': "{/literal}{if $sCategoryInfo}{$sCategoryInfo.id}{elseif $sArticle.categoryID}{$sArticle.categoryID}{/if}{literal}",
        'pageSubCategory': '',
        'pageSubCategoryID': '',
        'pageCountryCode': "{/literal}{$lang}{literal}",
        'pageLanguageCode': "{/literal}{$language}{literal}",
        'pageValue': 1.0,
        'pageVersion': 1,
        'pageAttributes': 1,
        'pageTestVariation': 1,

        {/literal}{if $sUserLoggedIn}{literal}
        // Visitor Data
        'visitorId': "{/literal}{$sUserData.additional.user.id}{literal}",
        'visitorLoginState': 'logged in',
        'visitorType': "{/literal}{if $sUserData.billingaddress.company}Geschäftskunde{else}Privatkunde{/if}{literal}",
        'visitorTypeState': "{/literal}{if $sUserData.billingaddress.company}Geschäftskunde{else}Privatkunde{/if}{literal}",
        'visitorLifetimeValue': 0,
        'visitorExistingCustomer': "{/literal}{if $sUserData.additional.user.accountmode == '1'}yes{else}no{/if}{literal}",
        {/literal}{else}{literal}
        'visitorLoginState': 'logged out',
        {/literal}{/if}{literal}

        // Search Data
        'siteSearchTerm': '',
        'siteSearchFrom': '',
        'siteSearchCategory': '',
        'siteSearchResults': 0,
    {/literal}
{/if}

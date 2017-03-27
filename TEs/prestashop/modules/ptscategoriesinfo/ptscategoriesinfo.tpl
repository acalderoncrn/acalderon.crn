{*
* Pts Prestashop Theme Framework for Prestashop 1.6.x
*
* @package   ptscategoriesinfo
* @version   1.0
* @author    http://www.prestabrain.com
* @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
*               <info@prestabrain.com>.All rights reserved.
* @license   GNU General Public License version 2
*}
{if $infos|@count > 0}
<!-- MODULE Block reinsurance -->
<div id="ptscategoriesinfo_block" class="clearfix">
    <ul class="width{$nbblocks}">	
        {foreach from=$infos item=info}
            <li{if $info.addition_class} class="{$info.addition_class}"{/if}>
                {if $show_banner}
                    <img src="{$link->getMediaLink("`$module_dir`img/`$info.file_name|escape:'htmlall':'UTF-8'`")}" alt="{$info.text|escape:html:'UTF-8'}" /> 
                {/if}
                <h3>{$info.title|escape:html:'UTF-8'}</h3>

                {if $nb_products}
                	<span>{l s='Products: ' mod='ptscategoriesinfo'}{$info.nb_products}</span>
                {/if}
                {if $show_des}
                    <span>{$info.text}</span>
                {/if}
                {if $show_subcategory && $info.subcategories}
                    <ul>
                    {foreach from=$info.subcategories item=subcategory name=subcategory_name}
                        <li><a href="{$link->getCategoryLink({$subcategory.id_category})}" title="{$subcategory.name|escape:'htmlall':'UTF-8'}">{$subcategory.name|escape:'htmlall':'UTF-8'}</a></li>
                    {/foreach}
                    </ul>
                {/if}
            </li>                        
        {/foreach}
    </ul>
</div>
<!-- /MODULE Block reinsurance -->
{/if}
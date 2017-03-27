{*
* Pts Prestashop Theme Framework for Prestashop 1.6.x
*
* @package   ptsblockprodcarousel
* @version   5.0
* @author    http://www.prestabrain.com
* @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
*               <info@prestabrain.com>.All rights reserved.
* @license   GNU General Public License version 2
*}
<div id="categoriesprodtabs" class="block products_block exclusive ptsblockprodcarousel carousel">
	<h3>{l s='Latest Products' mod='ptsblockprodcarousel'}</h3>
	<div class="block_content">	
		{if !empty($products )}
			{$tabname="ptsblockprodcarousel"}
			{include file="{$product_tpl}"} 
		{/if}
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('{$tabname}').each(function(){
        $(this).carousel({
            pause: true,
            interval: {$interval},
        });
    });
});
</script>
 
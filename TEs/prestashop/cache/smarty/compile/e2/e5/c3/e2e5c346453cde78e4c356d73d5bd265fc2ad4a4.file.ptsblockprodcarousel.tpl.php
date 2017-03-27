<?php /* Smarty version Smarty-3.1.19, created on 2017-03-15 19:08:49
         compiled from "/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/pf_fashion_store/modules/ptsblockprodcarousel/ptsblockprodcarousel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:193129934458c983310860c8-46498548%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e2e5c346453cde78e4c356d73d5bd265fc2ad4a4' => 
    array (
      0 => '/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/pf_fashion_store/modules/ptsblockprodcarousel/ptsblockprodcarousel.tpl',
      1 => 1489601285,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '193129934458c983310860c8-46498548',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'products' => 0,
    'tabname' => 0,
    'interval' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58c983310dc848_80347364',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58c983310dc848_80347364')) {function content_58c983310dc848_80347364($_smarty_tpl) {?>


<!-- MODULE Block categoriesprodtabs -->
<div class="col-sm-6">
	<div id="categoriesprodtabs" class="block products_block exclusive ptsblockprodcarousel carousel">
		<div class="title_block black"><span><?php echo smartyTranslate(array('s'=>'Latest Products','mod'=>'ptsblockprodcarousel'),$_smarty_tpl);?>
</span></div>
		<div class="block_content row">	
			<?php if (!empty($_smarty_tpl->tpl_vars['products']->value)) {?>
				<?php $_smarty_tpl->tpl_vars['tabname'] = new Smarty_variable("ptsblockprodcarousel", null, 0);?>
				<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./product-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
 
			<?php }?>
		</div>
	</div>
</div>
<!-- /MODULE Block categoriesprodtabs -->
<script type="text/javascript">
$(document).ready(function() {
    $('<?php echo $_smarty_tpl->tpl_vars['tabname']->value;?>
').each(function(){
        $(this).carousel({
            pause: true,
            interval: <?php echo $_smarty_tpl->tpl_vars['interval']->value;?>
,
        });
    });
});
</script>
 <?php }} ?>

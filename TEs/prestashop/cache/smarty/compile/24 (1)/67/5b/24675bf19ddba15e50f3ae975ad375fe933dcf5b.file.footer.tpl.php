<?php /* Smarty version Smarty-3.1.19, created on 2017-03-15 19:25:10
         compiled from "/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/modules/leocustomajax/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:212121202358c9870685c881-24200721%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '24675bf19ddba15e50f3ae975ad375fe933dcf5b' => 
    array (
      0 => '/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/modules/leocustomajax/footer.tpl',
      1 => 1489602279,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '212121202358c9870685c881-24200721',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'leo_customajax_pn' => 0,
    'leo_customajax_img' => 0,
    'leo_customajax_tran' => 0,
    'leo_customajax_count' => 0,
    'leo_customajax_acolor' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58c987068722b6_75002461',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58c987068722b6_75002461')) {function content_58c987068722b6_75002461($_smarty_tpl) {?>

<script type="text/javascript">
	var leoOption = {
		productNumber:<?php if ($_smarty_tpl->tpl_vars['leo_customajax_pn']->value) {?><?php echo $_smarty_tpl->tpl_vars['leo_customajax_pn']->value;?>
<?php } else { ?>0<?php }?>,
		productInfo:<?php if ($_smarty_tpl->tpl_vars['leo_customajax_img']->value) {?><?php echo $_smarty_tpl->tpl_vars['leo_customajax_img']->value;?>
<?php } else { ?>0<?php }?>,
		productTran:<?php if ($_smarty_tpl->tpl_vars['leo_customajax_tran']->value) {?><?php echo $_smarty_tpl->tpl_vars['leo_customajax_tran']->value;?>
<?php } else { ?>0<?php }?>,
		productCdown: <?php if ($_smarty_tpl->tpl_vars['leo_customajax_count']->value) {?><?php echo $_smarty_tpl->tpl_vars['leo_customajax_count']->value;?>
<?php } else { ?>0<?php }?>,
		productColor: <?php if ($_smarty_tpl->tpl_vars['leo_customajax_acolor']->value) {?><?php echo $_smarty_tpl->tpl_vars['leo_customajax_acolor']->value;?>
<?php } else { ?>0<?php }?>,
	}
    $(document).ready(function(){	
		var leoCustomAjax = new $.LeoCustomAjax();
        leoCustomAjax.processAjax();
    });
</script><?php }} ?>

<?php /* Smarty version Smarty-3.1.19, created on 2017-03-16 17:38:41
         compiled from "/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/admin475tlphiv/themes/default/template/controllers/products/helpers/tree/tree_toolbar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:96961159358cabf9185a433-58102408%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '74ed6325ac4bdf76a412985527275e76b53542d0' => 
    array (
      0 => '/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/admin475tlphiv/themes/default/template/controllers/products/helpers/tree/tree_toolbar.tpl',
      1 => 1482157020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96961159358cabf9185a433-58102408',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'actions' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58cabf91923296_56584415',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58cabf91923296_56584415')) {function content_58cabf91923296_56584415($_smarty_tpl) {?>
<div class="tree-actions pull-right">
	<?php if (isset($_smarty_tpl->tpl_vars['actions']->value)) {?>
	<?php  $_smarty_tpl->tpl_vars['action'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['action']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['actions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['action']->key => $_smarty_tpl->tpl_vars['action']->value) {
$_smarty_tpl->tpl_vars['action']->_loop = true;
?>
		<?php echo $_smarty_tpl->tpl_vars['action']->value->render();?>

	<?php } ?>
	<?php }?>
</div><?php }} ?>

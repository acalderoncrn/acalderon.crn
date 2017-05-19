<?php /* Smarty version Smarty-3.1.19, created on 2017-03-15 19:25:10
         compiled from "/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/modules/leomanagewidgets/views/widgets/widget_html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:158221600958c98706be1bb9-88646463%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd80902af1a07c4ff5a643933bfcbfa54c4a16fe0' => 
    array (
      0 => '/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/modules/leomanagewidgets/views/widgets/widget_html.tpl',
      1 => 1489602279,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '158221600958c98706be1bb9-88646463',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'html' => 0,
    'widget_heading' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58c98706bef401_45625130',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58c98706bef401_45625130')) {function content_58c98706bef401_45625130($_smarty_tpl) {?>

<?php if (isset($_smarty_tpl->tpl_vars['html']->value)) {?>
<div class="widget-html block">
	<?php if (isset($_smarty_tpl->tpl_vars['widget_heading']->value)&&!empty($_smarty_tpl->tpl_vars['widget_heading']->value)) {?>
	<h4 class="title_block">
		<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['widget_heading']->value, ENT_QUOTES, 'UTF-8', true);?>

	</h4>
	<?php }?>
	<div class="block_content">
		<?php echo $_smarty_tpl->tpl_vars['html']->value;?>

	</div>
</div>
<?php }?><?php }} ?>

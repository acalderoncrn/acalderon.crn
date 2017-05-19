<?php /* Smarty version Smarty-3.1.19, created on 2017-03-16 17:27:30
         compiled from "/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/admin475tlphiv/themes/default/template/helpers/list/list_action_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:121885734858cabcf2af1a87-98846877%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '98e86376df26fe9ebd780146e18fdc686a8952c5' => 
    array (
      0 => '/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/admin475tlphiv/themes/default/template/helpers/list/list_action_edit.tpl',
      1 => 1482157020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121885734858cabcf2af1a87-98846877',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58cabcf2afad32_69655068',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58cabcf2afad32_69655068')) {function content_58cabcf2afad32_69655068($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="edit">
	<i class="icon-pencil"></i> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>

</a><?php }} ?>

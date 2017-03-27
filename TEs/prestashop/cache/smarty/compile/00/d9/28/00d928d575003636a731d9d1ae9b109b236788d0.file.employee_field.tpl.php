<?php /* Smarty version Smarty-3.1.19, created on 2017-03-22 19:28:01
         compiled from "/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/acalderon.crn/TEs/prestashop/admin475tlphiv/themes/default/template/controllers/logs/employee_field.tpl" */ ?>
<?php /*%%SmartyHeaderCode:197953047558d2c231e6c2a9-40973007%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00d928d575003636a731d9d1ae9b109b236788d0' => 
    array (
      0 => '/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/acalderon.crn/TEs/prestashop/admin475tlphiv/themes/default/template/controllers/logs/employee_field.tpl',
      1 => 1482157020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197953047558d2c231e6c2a9-40973007',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'employee_image' => 0,
    'employee_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58d2c231e700d9_91961657',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58d2c231e700d9_91961657')) {function content_58d2c231e700d9_91961657($_smarty_tpl) {?>
<span class="employee_avatar_small">
	<img class="imgm img-thumbnail" alt="" src="<?php echo $_smarty_tpl->tpl_vars['employee_image']->value;?>
" width="32" height="32" />
</span>
<?php echo $_smarty_tpl->tpl_vars['employee_name']->value;?>
<?php }} ?>

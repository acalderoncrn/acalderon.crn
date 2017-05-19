<?php /* Smarty version Smarty-3.1.19, created on 2017-03-16 17:26:06
         compiled from "/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/default-bootstrap/modules/blockcategories/blockcategories.tpl" */ ?>
<?php /*%%SmartyHeaderCode:169959531658cabc9eb4afc2-18392684%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40b982e679673e65f9fc71668d38d49490b1c1d4' => 
    array (
      0 => '/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/default-bootstrap/modules/blockcategories/blockcategories.tpl',
      1 => 1482157024,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '169959531658cabc9eb4afc2-18392684',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'blockCategTree' => 0,
    'currentCategory' => 0,
    'isDhtml' => 0,
    'child' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58cabc9ec47c37_26688716',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58cabc9ec47c37_26688716')) {function content_58cabc9ec47c37_26688716($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['blockCategTree']->value&&count($_smarty_tpl->tpl_vars['blockCategTree']->value['children'])) {?>
<!-- Block categories module -->
<div id="categories_block_left" class="block">
	<h2 class="title_block">
		<?php if (isset($_smarty_tpl->tpl_vars['currentCategory']->value)) {?>
			<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentCategory']->value->name, ENT_QUOTES, 'UTF-8', true);?>

		<?php } else { ?>
			<?php echo smartyTranslate(array('s'=>'Categories','mod'=>'blockcategories'),$_smarty_tpl);?>

		<?php }?>
	</h2>
	<div class="block_content">
		<ul class="tree <?php if ($_smarty_tpl->tpl_vars['isDhtml']->value) {?>dhtml<?php }?>">
			<?php  $_smarty_tpl->tpl_vars['child'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['child']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['blockCategTree']->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['child']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['child']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['child']->key => $_smarty_tpl->tpl_vars['child']->value) {
$_smarty_tpl->tpl_vars['child']->_loop = true;
 $_smarty_tpl->tpl_vars['child']->iteration++;
 $_smarty_tpl->tpl_vars['child']->last = $_smarty_tpl->tpl_vars['child']->iteration === $_smarty_tpl->tpl_vars['child']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['blockCategTree']['last'] = $_smarty_tpl->tpl_vars['child']->last;
?>
				<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['blockCategTree']['last']) {?>
					<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['branche_tpl_path']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('node'=>$_smarty_tpl->tpl_vars['child']->value,'last'=>'true'), 0);?>

				<?php } else { ?>
					<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['branche_tpl_path']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('node'=>$_smarty_tpl->tpl_vars['child']->value), 0);?>

				<?php }?>
			<?php } ?>
		</ul>
	</div>
</div>
<!-- /Block categories module -->
<?php }?>
<?php }} ?>

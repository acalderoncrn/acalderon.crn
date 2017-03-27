<?php /* Smarty version Smarty-3.1.19, created on 2017-02-21 20:02:34
         compiled from "/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/default-bootstrap/modules/mailalerts/views/templates/hook/product.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7730553558ac8eca8c2087-12808384%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '24d8d739b2209245205b1eab8bce785158afc39c' => 
    array (
      0 => '/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/default-bootstrap/modules/mailalerts/views/templates/hook/product.tpl',
      1 => 1482157024,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7730553558ac8eca8c2087-12808384',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'email' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58ac8eca8effd2_52392153',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58ac8eca8effd2_52392153')) {function content_58ac8eca8effd2_52392153($_smarty_tpl) {?>
<!-- MODULE MailAlerts -->
	<?php if (isset($_smarty_tpl->tpl_vars['email']->value)&&$_smarty_tpl->tpl_vars['email']->value) {?>
		<p class="form-group">
			<input type="text" id="oos_customer_email" name="customer_email" size="20" value="<?php echo smartyTranslate(array('s'=>'your@email.com','mod'=>'mailalerts'),$_smarty_tpl);?>
" class="mailalerts_oos_email form-control" />
    	</p>
    <?php }?>
	<a href="#" title="<?php echo smartyTranslate(array('s'=>'Notify me when available','mod'=>'mailalerts'),$_smarty_tpl);?>
" id="mailalert_link" rel="nofollow"><?php echo smartyTranslate(array('s'=>'Notify me when available','mod'=>'mailalerts'),$_smarty_tpl);?>
</a>
	<span id="oos_customer_email_result" style="display:none; display: block;"></span>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('oosHookJsCodeFunctions'=>array('oosHookJsCodeMailAlert')),$_smarty_tpl);?>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('mailalerts_url_check'=>$_smarty_tpl->tpl_vars['link']->value->getModuleLink('mailalerts','actions',array('process'=>'check'))),$_smarty_tpl);?>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('mailalerts_url_add'=>$_smarty_tpl->tpl_vars['link']->value->getModuleLink('mailalerts','actions',array('process'=>'add'))),$_smarty_tpl);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'mailalerts_placeholder')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'mailalerts_placeholder'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'your@email.com','mod'=>'mailalerts','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'mailalerts_placeholder'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'mailalerts_registered')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'mailalerts_registered'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Request notification registered','mod'=>'mailalerts','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'mailalerts_registered'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'mailalerts_already')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'mailalerts_already'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'You already have an alert for this product','mod'=>'mailalerts','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'mailalerts_already'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'mailalerts_invalid')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'mailalerts_invalid'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Your e-mail address is invalid','mod'=>'mailalerts','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'mailalerts_invalid'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<!-- END : MODULE MailAlerts --><?php }} ?>

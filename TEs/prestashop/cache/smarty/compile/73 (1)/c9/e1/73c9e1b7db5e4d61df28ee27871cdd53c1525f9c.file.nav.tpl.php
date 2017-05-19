<?php /* Smarty version Smarty-3.1.19, created on 2017-03-16 17:26:08
         compiled from "/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/default-bootstrap/modules/blockuserinfo/nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:197967669658cabca0069125-81532809%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '73c9e1b7db5e4d61df28ee27871cdd53c1525f9c' => 
    array (
      0 => '/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/default-bootstrap/modules/blockuserinfo/nav.tpl',
      1 => 1482157024,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197967669658cabca0069125-81532809',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'is_logged' => 0,
    'link' => 0,
    'cookie' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58cabca00ca4b0_10504529',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58cabca00ca4b0_10504529')) {function content_58cabca00ca4b0_10504529($_smarty_tpl) {?><!-- Block user information module NAV  -->
<?php if ($_smarty_tpl->tpl_vars['is_logged']->value) {?>
	<div class="header_user_info">
		<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View my customer account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="account" rel="nofollow"><span><?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_firstname;?>
 <?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_lastname;?>
</span></a>
	</div>
<?php }?>
<div class="header_user_info">
	<?php if ($_smarty_tpl->tpl_vars['is_logged']->value) {?>
		<a class="logout" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true,null,"mylogout"), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Log me out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
">
			<?php echo smartyTranslate(array('s'=>'Sign out','mod'=>'blockuserinfo'),$_smarty_tpl);?>

		</a>
	<?php } else { ?>
		<a class="login" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Log in to your customer account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
">
			<?php echo smartyTranslate(array('s'=>'Sign in','mod'=>'blockuserinfo'),$_smarty_tpl);?>

		</a>
	<?php }?>
</div>
<!-- /Block usmodule NAV -->
<?php }} ?>

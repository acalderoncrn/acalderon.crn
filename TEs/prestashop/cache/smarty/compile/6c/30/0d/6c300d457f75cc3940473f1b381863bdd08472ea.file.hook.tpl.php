<?php /* Smarty version Smarty-3.1.19, created on 2017-03-15 19:08:48
         compiled from "/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/pf_fashion_store/modules/ptsstaticcontent/views/templates/hook/hook.tpl" */ ?>
<?php /*%%SmartyHeaderCode:70739045058c98330c3e390-94754038%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c300d457f75cc3940473f1b381863bdd08472ea' => 
    array (
      0 => '/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/pf_fashion_store/modules/ptsstaticcontent/views/templates/hook/hook.tpl',
      1 => 1489601285,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70739045058c98330c3e390-94754038',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_name' => 0,
    'htmlitems' => 0,
    'hookcols' => 0,
    'hook' => 0,
    'hItem' => 0,
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58c98330c897b8_39547694',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58c98330c897b8_39547694')) {function content_58c98330c897b8_39547694($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['page_name']->value=='index') {?>
<?php if (isset($_smarty_tpl->tpl_vars['htmlitems']->value)&&$_smarty_tpl->tpl_vars['htmlitems']->value) {?>

<?php if ((int)$_smarty_tpl->tpl_vars['hookcols']->value>0) {?>
<?php $_smarty_tpl->tpl_vars["hcol"] = new Smarty_variable(12/$_smarty_tpl->tpl_vars['hookcols']->value, null, 0);?>
<?php } else { ?>
<?php $_smarty_tpl->tpl_vars["hcol"] = new Smarty_variable(4, null, 0);?>
<?php }?>

<div id="ptsstaticontent_<?php echo $_smarty_tpl->tpl_vars['hook']->value;?>
" class="row">
    <ul class="staticontent-home clearfix">
        <?php  $_smarty_tpl->tpl_vars['hItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['hItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['htmlitems']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['items']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['hItem']->key => $_smarty_tpl->tpl_vars['hItem']->value) {
$_smarty_tpl->tpl_vars['hItem']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['items']['iteration']++;
?>
            <?php if ($_smarty_tpl->tpl_vars['hItem']->value['col_lg']<=0) {?>
            <?php $_smarty_tpl->createLocalArrayVariable('hItem', null, 0);
$_smarty_tpl->tpl_vars['hItem']->value['col_lg'] = floor(12/count($_smarty_tpl->tpl_vars['htmlitems']->value));?>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['hItem']->value['col_sm']<=0) {?>
            <?php $_smarty_tpl->createLocalArrayVariable('hItem', null, 0);
$_smarty_tpl->tpl_vars['hItem']->value['col_sm'] = 12;?>
            <?php }?>


        	<li class="staticontent-item-<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['items']['iteration'];?>
 col-lg-<?php echo $_smarty_tpl->tpl_vars['hItem']->value['col_lg'];?>
 col-xs-<?php echo $_smarty_tpl->tpl_vars['hItem']->value['col_sm'];?>
 <?php echo $_smarty_tpl->tpl_vars['hItem']->value['class'];?>
">
			<div>
            	<?php if ($_smarty_tpl->tpl_vars['hItem']->value['url']) {?>
                	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['hItem']->value['url'], ENT_QUOTES, 'UTF-8', true);?>
" class="item-link"<?php if ($_smarty_tpl->tpl_vars['hItem']->value['target']==1) {?> target="_blank"<?php }?>>
                <?php }?>
	            	<?php if ($_smarty_tpl->tpl_vars['hItem']->value['image']) {?>
	                	<img src="<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
images/<?php echo $_smarty_tpl->tpl_vars['hItem']->value['image'];?>
" class="item-img img-responsive" alt="" />
	                <?php }?>
	            	<?php if ($_smarty_tpl->tpl_vars['hItem']->value['title']&&$_smarty_tpl->tpl_vars['hItem']->value['title_use']==1) {?>
                        <h3 class="item-title"><?php echo $_smarty_tpl->tpl_vars['hItem']->value['title'];?>
</h3>
	                <?php }?>
	            	<?php if ($_smarty_tpl->tpl_vars['hItem']->value['html']) {?>
	                	<div class="item-html">
                        	<?php echo $_smarty_tpl->tpl_vars['hItem']->value['html'];?>
            
                        </div>
	                <?php }?>
            	<?php if ($_smarty_tpl->tpl_vars['hItem']->value['url']) {?>
                	</a>
                <?php }?>
			</div>
            </li>
        <?php } ?>
    </ul>
</div>
<?php }?>
<?php }?>

<?php }} ?>

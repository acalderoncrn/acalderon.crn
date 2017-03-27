<?php /* Smarty version Smarty-3.1.19, created on 2017-03-15 19:08:49
         compiled from "/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/pf_fashion_store/modules/ptscategoriesinfo/ptscategoriesinfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:149384118458c9833195f075-89061762%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '76fe0e51596e17812681ca5186c176bcddabb10e' => 
    array (
      0 => '/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/pf_fashion_store/modules/ptscategoriesinfo/ptscategoriesinfo.tpl',
      1 => 1489601285,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149384118458c9833195f075-89061762',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'infos' => 0,
    'info' => 0,
    'link' => 0,
    'module_dir' => 0,
    'show_subcategory' => 0,
    'sub' => 0,
    'nb_products' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58c9833199fdc4_58752776',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58c9833199fdc4_58752776')) {function content_58c9833199fdc4_58752776($_smarty_tpl) {?>
<?php if (count($_smarty_tpl->tpl_vars['infos']->value)>0) {?>
<div id="ptscategoriesinfo_block">
    <ul class="clearfix">	
        <?php  $_smarty_tpl->tpl_vars['info'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['info']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['infos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['info']->key => $_smarty_tpl->tpl_vars['info']->value) {
$_smarty_tpl->tpl_vars['info']->_loop = true;
?>
            <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4 <?php if ($_smarty_tpl->tpl_vars['info']->value['addition_class']) {?><?php echo $_smarty_tpl->tpl_vars['info']->value['addition_class'];?>
<?php }?>">
				<div class="box-items">
					<div class="items">
						<a class="" href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['info']->value['id_category'];?>
<?php $_tmp4=ob_get_clean();?><?php echo $_smarty_tpl->tpl_vars['link']->value->getCategoryLink($_tmp4);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['info']->value['category_title'], ENT_QUOTES, 'UTF-8', true);?>
">
							<img class="img-responsive" src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)$_smarty_tpl->tpl_vars['module_dir']->value)."img/".((string)mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['info']->value['file_name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')));?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['info']->value['text'], ENT_QUOTES, 'UTF-8', true);?>
" /> 																	
						</a>
						<?php if ($_smarty_tpl->tpl_vars['info']->value['text']) {?>
							<p class="product_description"><?php echo $_smarty_tpl->tpl_vars['info']->value['text'];?>
</p>
						<?php }?>
						<div class="item-html">
							<?php if ($_smarty_tpl->tpl_vars['show_subcategory']->value&&$_smarty_tpl->tpl_vars['info']->value['subcategories']) {?>
							<ul class="sub-category-name">
								<?php  $_smarty_tpl->tpl_vars['sub'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sub']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['info']->value['subcategories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sub']->key => $_smarty_tpl->tpl_vars['sub']->value) {
$_smarty_tpl->tpl_vars['sub']->_loop = true;
?>
									<li><a class="" href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['sub']->value['id_category'];?>
<?php $_tmp5=ob_get_clean();?><?php echo $_smarty_tpl->tpl_vars['link']->value->getCategoryLink($_tmp5);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sub']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sub']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</a></li>
								<?php } ?>
							</ul>	
							<?php }?>
							<div class="title_info">
								<?php if ($_smarty_tpl->tpl_vars['info']->value['title']) {?><p class="categoriesinfo_title title_image"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['info']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</p></br><?php }?>
								<?php if ($_smarty_tpl->tpl_vars['nb_products']->value) {?>
									<p class="product_number"><?php echo $_smarty_tpl->tpl_vars['info']->value['nb_products'];?>
</p>
								<?php }?>
							</div>							
						</div>							
					</div>
				</div>
            </li>                        
        <?php } ?>
    </ul>
</div>
<!-- /MODULE Block reinsurance -->
<?php }?><?php }} ?>

<?php /* Smarty version Smarty-3.1.19, created on 2017-03-15 19:08:49
         compiled from "/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/pf_fashion_store/modules/ptsblockmanufacturer/ptsblockmanufacturer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:82876972358c98331b6c6f3-94424004%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7aacda7498434c54cf0189d994cb09818b3906f' => 
    array (
      0 => '/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/pf_fashion_store/modules/ptsblockmanufacturer/ptsblockmanufacturer.tpl',
      1 => 1489601285,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '82876972358c98331b6c6f3-94424004',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'show_title' => 0,
    'ptsmanufacturers' => 0,
    'tabname' => 0,
    'manuf_page' => 0,
    'ptsmanufacterer' => 0,
    'active' => 0,
    'scolumn' => 0,
    'manuf' => 0,
    'interval' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58c98331ba2cc5_28562921',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58c98331ba2cc5_28562921')) {function content_58c98331ba2cc5_28562921($_smarty_tpl) {?><div id="ptsblockmanufacturer" class="block ptsblockmanufacturer carousel slide col-xs-12 col-sm-12">
	<div class="row">
		<?php if ($_smarty_tpl->tpl_vars['show_title']->value) {?>
			<div class="title_block transparent"><span><?php echo smartyTranslate(array('s'=>'Our Brands','mod'=>'ptsblockmanufacturer'),$_smarty_tpl);?>
</span></div>
		<?php }?>

		<div class="block_content">
			<?php if (!empty($_smarty_tpl->tpl_vars['ptsmanufacturers']->value)) {?>
				<?php $_smarty_tpl->tpl_vars['tabname'] = new Smarty_variable("ptsblockmanufacturer", null, 0);?>
				<?php if (!empty($_smarty_tpl->tpl_vars['ptsmanufacturers']->value)) {?>
					<div id="<?php echo $_smarty_tpl->tpl_vars['tabname']->value;?>
">
						<div class="controls-direction">
							<?php if (count($_smarty_tpl->tpl_vars['ptsmanufacturers']->value)>$_smarty_tpl->tpl_vars['manuf_page']->value) {?>
								<a class="carousel-control left" href="#<?php echo $_smarty_tpl->tpl_vars['tabname']->value;?>
"   data-slide="prev"><i class="icon-chevron-left"></i></a>
								<a class="carousel-control right" href="#<?php echo $_smarty_tpl->tpl_vars['tabname']->value;?>
"  data-slide="next"><i class="icon-chevron-right"></i></a>
							<?php }?>
						</div>
						<div class="carousel-inner row">
							<?php $_smarty_tpl->tpl_vars['ptsmanufacterer'] = new Smarty_variable(array_chunk($_smarty_tpl->tpl_vars['ptsmanufacturers']->value,$_smarty_tpl->tpl_vars['manuf_page']->value), null, 0);?>
							<?php  $_smarty_tpl->tpl_vars['ptsmanufacturers'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ptsmanufacturers']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ptsmanufacterer']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['ptsmanufacturers']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['ptsmanufacturers']->key => $_smarty_tpl->tpl_vars['ptsmanufacturers']->value) {
$_smarty_tpl->tpl_vars['ptsmanufacturers']->_loop = true;
 $_smarty_tpl->tpl_vars['ptsmanufacturers']->index++;
 $_smarty_tpl->tpl_vars['ptsmanufacturers']->first = $_smarty_tpl->tpl_vars['ptsmanufacturers']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['mypLoop']['first'] = $_smarty_tpl->tpl_vars['ptsmanufacturers']->first;
?>
								<div class="item <?php if (isset($_smarty_tpl->tpl_vars['active']->value)&&$_smarty_tpl->tpl_vars['active']->value==1) {?> active<?php }?> item <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['mypLoop']['first']) {?>active<?php }?>">
									<?php  $_smarty_tpl->tpl_vars['manuf'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['manuf']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ptsmanufacturers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['manuf']->key => $_smarty_tpl->tpl_vars['manuf']->value) {
$_smarty_tpl->tpl_vars['manuf']->_loop = true;
?>
										<div class="col-xs-12 col-sm-6 col-md-<?php echo $_smarty_tpl->tpl_vars['scolumn']->value;?>
 col-lg-<?php echo $_smarty_tpl->tpl_vars['scolumn']->value;?>
">
											<div class="block_manuf clearfix">
												<?php if ($_smarty_tpl->tpl_vars['manuf']->value['linkIMG']) {?>
													<div class="blog-image">
														<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['manuf']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
">
															<img class="img-responsive" src="<?php echo $_smarty_tpl->tpl_vars['manuf']->value['linkIMG'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['manuf']->value['name'];?>
" vspace="0" border="0" />
														</a>
													</div>
												<?php }?>
											</div>
										</div>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php }?>
			<?php }?>
		</div>
	</div>
</div>
<!-- /MODULE Block ptsblockmanufacturer -->

 
  <script type="text/javascript">
  $(document).ready(function() {
      $('#<?php echo $_smarty_tpl->tpl_vars['tabname']->value;?>
').each(function(){
          $(this).carousel({
              pause: 'hover',
              interval: <?php echo $_smarty_tpl->tpl_vars['interval']->value;?>

          });
      });
  });
  </script>
 <?php }} ?>

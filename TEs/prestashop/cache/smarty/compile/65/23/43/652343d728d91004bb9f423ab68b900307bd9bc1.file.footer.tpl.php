<?php /* Smarty version Smarty-3.1.19, created on 2017-03-15 19:08:49
         compiled from "/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/pf_fashion_store/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:92284986858c98331a0abb1-77323048%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '652343d728d91004bb9f423ab68b900307bd9bc1' => 
    array (
      0 => '/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/pf_fashion_store/footer.tpl',
      1 => 1489601285,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '92284986858c98331a0abb1-77323048',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_only' => 0,
    'right_column_size' => 0,
    'HOOK_RIGHT_COLUMN' => 0,
    'page_name' => 0,
    'HOOK_FOOTER' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58c98331a336e8_59391616',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58c98331a336e8_59391616')) {function content_58c98331a336e8_59391616($_smarty_tpl) {?>
<?php if (!isset($_smarty_tpl->tpl_vars['content_only']->value)||!$_smarty_tpl->tpl_vars['content_only']->value) {?>
					</div><!-- #center_column -->
					<?php if (isset($_smarty_tpl->tpl_vars['right_column_size']->value)&&!empty($_smarty_tpl->tpl_vars['right_column_size']->value)) {?>
						<div id="right_column" class="col-xs-12 col-md-<?php echo intval($_smarty_tpl->tpl_vars['right_column_size']->value);?>
 column sidebar"><?php echo $_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value;?>
</div>
					<?php }?>
					</div><!-- .row -->
				</div><!-- #columns -->
			</div><!-- .columns-container -->
			<?php if ($_smarty_tpl->tpl_vars['page_name']->value=='index') {?>
			<div id="object" class="bottom parallax hidden-md hidden-xs hidden-sm">			
				<div class="container">
					<div class="row">
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayBottom"),$_smarty_tpl);?>

					</div>
				</div>						
			</div>	
			<?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['HOOK_FOOTER']->value)) {?>
			<!-- Footer -->
			<div id="footer_container" class="footer-container">
				<div id="footer">
					<div id="pts-footertop" class="footer-top">
						<div class="container">
							<div class="inner">
								<div class="row">
									<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayFootertop'),$_smarty_tpl);?>
								
								</div>
							</div>
						</div>
					</div>
					<div id="pts-footercenter" class="footer-center">
						<div class="container"><div class="inner">
							<div class="row">
								<?php echo PtsPlugin::smartyplugin(array('module'=>'blocknewsletter','hook'=>'footer'),$_smarty_tpl);?>

								<?php echo PtsPlugin::smartyplugin(array('module'=>'blocksocial','hook'=>'footer'),$_smarty_tpl);?>
								
							</div>
						</div></div>
					</div>
					<div id="pts-footerbottom" class="footer-bottom">
						<div class="container"><div class="inner">
							<div class="row">
								<?php echo $_smarty_tpl->tpl_vars['HOOK_FOOTER']->value;?>
	
								<?php echo PtsPlugin::smartyplugin(array('module'=>'blocktags','hook'=>'leftColumn'),$_smarty_tpl);?>
									
							</div>
						</div></div>
					</div>
				</div>
			</div>
			<div id="pts-copyright" class="copyright">
				<div class="container"><div class="inner">
					<span>Copyright By Your Store © <?php echo date('Y');?>
</span>.
					<span class="powered"><?php echo smartyTranslate(array('s'=>'Powered By'),$_smarty_tpl);?>
 <a href="http://www.prestashop.com" title="prestashop"><?php echo smartyTranslate(array('s'=>'Prestashop'),$_smarty_tpl);?>
</a></span>
					<div class="pts-paypal pull-right">
						<a title="PrestaBrain" href="http://www.prestashop.com">Paypal</a>
					</div>
				</div>
			</div>
			<?php }?>
		</div><!-- #page -->
<?php }?>
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./global.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	
	</body>
</html><?php }} ?>

<?php /* Smarty version Smarty-3.1.19, created on 2017-03-15 19:25:13
         compiled from "/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/leo_tshirt/modules/leomanagewidgets/views/widgets/widget_categoriestabs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:46053883358c98709d2d804-49486422%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49ae42f3de462cb9d3c09bd1f9667d8a676c28be' => 
    array (
      0 => '/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/leo_tshirt/modules/leomanagewidgets/views/widgets/widget_categoriestabs.tpl',
      1 => 1489602279,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '46053883358c98709d2d804-49486422',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'myTab' => 0,
    'widget_heading' => 0,
    'leocategories' => 0,
    'category' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58c98709dc45e4_76316286',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58c98709dc45e4_76316286')) {function content_58c98709dc45e4_76316286($_smarty_tpl) {?>

<!-- MODULE Block specials -->
<div id="<?php echo $_smarty_tpl->tpl_vars['myTab']->value;?>
" class="products_block exclusive  block">
	<?php if (isset($_smarty_tpl->tpl_vars['widget_heading']->value)&&!empty($_smarty_tpl->tpl_vars['widget_heading']->value)) {?>
	<h4 class="page-subheading">
		<?php echo $_smarty_tpl->tpl_vars['widget_heading']->value;?>

	</h4>
	<?php }?>
	<div class="block_content">	
		<?php if (!empty($_smarty_tpl->tpl_vars['leocategories']->value)) {?>
			<ul class="nav nav-tabs">
			  <?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['leocategories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
				<li><a href="#<?php echo $_smarty_tpl->tpl_vars['myTab']->value;?>
<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</a></li>
			  <?php } ?>
			</ul>
			<div class="tab-content">
			 <?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['leocategories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
				<div class="tab-pane" id="<?php echo $_smarty_tpl->tpl_vars['myTab']->value;?>
<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
">
					<?php $_smarty_tpl->tpl_vars['products'] = new Smarty_variable($_smarty_tpl->tpl_vars['category']->value['products'], null, 0);?>  
					<?php $_smarty_tpl->tpl_vars["tabname"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['myTab']->value)."_".((string)$_smarty_tpl->tpl_vars['category']->value['id']), null, 0);?> 
					<?php echo $_smarty_tpl->getSubTemplate ('./products.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

				</div>
			<?php } ?>
			</div>
		<?php }?>
	</div>
</div>
<!-- /MODULE Block specials -->
<script type="text/javascript">

$(document).ready(function() {
    $('#<?php echo $_smarty_tpl->tpl_vars['myTab']->value;?>
 .carousel').each(function(){
        $(this).carousel({
            pause: true,
            interval: false
        });
    });
    
    $("#<?php echo $_smarty_tpl->tpl_vars['myTab']->value;?>
 .nav-tabs li", this).first().addClass("active");
    $("#<?php echo $_smarty_tpl->tpl_vars['myTab']->value;?>
 .tab-content .tab-pane", this).first().addClass("active");
});

</script>
 <?php }} ?>

<?php /* Smarty version Smarty-3.1.19, created on 2017-03-15 19:08:49
         compiled from "/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/pf_fashion_store/modules/ptstwitter/ptstwitter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:58665001558c9833139ec40-54335093%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fe7201c9e76886953b8159e9be1267d67e17524d' => 
    array (
      0 => '/Users/acalderon/Google Drive/AGS2 (1)/M08/m08calderon/TEs/prestashop/themes/pf_fashion_store/modules/ptstwitter/ptstwitter.tpl',
      1 => 1489601285,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '58665001558c9833139ec40-54335093',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'username' => 0,
    'theme' => 0,
    'width' => 0,
    'height' => 0,
    'chrome' => 0,
    'border_color' => 0,
    'count' => 0,
    'show_replies' => 0,
    'twidget_id' => 0,
    'js' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58c983313b45b6_73773932',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58c983313b45b6_73773932')) {function content_58c983313b45b6_73773932($_smarty_tpl) {?>
<?php if (isset($_smarty_tpl->tpl_vars['username']->value)) {?>
<div class="widget-twitter block col-lg-3 col-md-3 col-sm-12 col-xs-12 footer-block">
	<h4 class="title_block"><span><?php echo smartyTranslate(array('s'=>'Lastest tweets'),$_smarty_tpl);?>
</span></h4>
	<div class="toggle-footer widget-inner block_content">
		<a class="twitter-timeline" data-dnt="true" data-theme="<?php echo $_smarty_tpl->tpl_vars['theme']->value;?>
" data-link-color="#ffffff" style="width:<?php echo $_smarty_tpl->tpl_vars['width']->value;?>
; height:<?php echo $_smarty_tpl->tpl_vars['height']->value;?>
" data-chrome="<?php echo $_smarty_tpl->tpl_vars['chrome']->value;?>
 transparent" data-border-color="<?php echo $_smarty_tpl->tpl_vars['border_color']->value;?>
" lang="EN" data-tweet-limit="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" data-show-replies="<?php echo $_smarty_tpl->tpl_vars['show_replies']->value;?>
" href="https://twitter.com/<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
"  data-widget-id="<?php echo $_smarty_tpl->tpl_vars['twidget_id']->value;?>
">Tweets by @<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a>
		<?php echo $_smarty_tpl->tpl_vars['js']->value;?>

	</div>
</div>
<?php }?> 


<script type="text/javascript">
// Customize twitter feed
var hideTwitterAttempts = 0;
function hideTwitterBoxElements() {
 setTimeout( function() {
  if ( $('.widget-twitter').length ) {
   $('.widget-twitter .widget-inner iframe').each( function(){
    var ibody = $(this).contents().find( 'body' );
    if ( ibody.find( '.timeline .stream .h-feed li.tweet' ).length ) {
     ibody.find( '.p-nickname' ).css( 'color', '999999' );
     ibody.find( '.p-name' ).css( 'color', '#999999' );
     ibody.find( '.e-entry-title' ).css( 'color', '#999999' );
     ibody.find( 'ol.h-feed li:first-child' ).css( 'padding', '0' );
    } else {
     $(this).hide();
    }
   });
  }
  hideTwitterAttempts++;
  if ( hideTwitterAttempts < 3 ) {
   hideTwitterBoxElements();
  }
 }, 2500);
}
// somewhere in your code after html page load
hideTwitterBoxElements();
</script><?php }} ?>

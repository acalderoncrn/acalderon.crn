<?php
/*
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2013 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class PtsPlugin extends Module
{
	public function __construct()
	{
		$this->name = 'ptsplugin';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'PrestaBrain';
		$this->need_instance = 0;

		parent::__construct();

		$this->bootstrap = true;
		$this->displayName = $this->l('Plugin module');
		$this->description = $this->l('This module allow you can move other module to anywhere.');
	}

	public function install()
	{
	 	if (!parent::install() || !$this->registerHook('displayHeader'))
	 		return false;

	 	return true;
	}
	
	public function hookdisplayHeader()
	{
		$this->context->smarty->registerPlugin('function', 'plugin', array('PtsPlugin', 'smartyplugin'));
	}

	public static function smartyplugin($params, &$smarty){

        $id_module = Module::getModuleIdByName($params['module']);
        $id_hook = Hook::getIdByName($params['hook']);
        $array = array();
        $array['id_hook']   = $id_hook;
        $array['module'] 	= $params['module'];
        $array['id_module'] = $id_module;
        
        return self::hookExec($params['hook'], isset($params['args']) ? $params['args'] : array(), $id_module, $array);
    }

	public static function hookExec( $hook_name, $hookArgs = array(), $id_module = NULL, $array = array() ){
		if ((!empty($id_module) AND !Validate::isUnsignedId($id_module)) OR !Validate::isHookName($hook_name))
			die(Tools::displayError());
		
		$context = Context::getContext();
        if (!isset($hookArgs['cookie']) || !$hookArgs['cookie'])
			$hookArgs['cookie'] = $context->cookie;
		if (!isset($hookArgs['cart']) || !$hookArgs['cart'])
			$hookArgs['cart'] = $context->cart;
        
		if ($id_module && $id_module != $array['id_module'])
			return ;
		if (!($moduleInstance = Module::getInstanceByName($array['module'])) || !$moduleInstance->active)
			return ;
		$retro_hook_name = Hook::getRetroHookName($hook_name);
		
		$hook_callable = is_callable(array($moduleInstance, 'hook'.$hook_name));
		$hook_retro_callable = is_callable(array($moduleInstance, 'hook'.$retro_hook_name));
		
		$output = '';
		if (($hook_callable || $hook_retro_callable) && Module::preCall($moduleInstance->name))
		{
			if ($hook_callable)
				$output = $moduleInstance->{'hook'.$hook_name}($hookArgs);
			else if ($hook_retro_callable)
				$output = $moduleInstance->{'hook'.$retro_hook_name}($hookArgs);
		}
		return $output;
	}

}



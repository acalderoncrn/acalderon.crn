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

class pf_import extends Module
{
	const INSTALL_SQL_FILE = 'data_sample.sql';
	var $themeName;
	var $sample_path;
	public function __construct()
	{
		$this->name = 'pf_import';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'PrestaBrain';
		$this->need_instance = 0;

		parent::__construct();
		$this->themeName = Context::getContext()->shop->getTheme();
		$this->sample_path = _PS_ALL_THEMES_DIR_ . $this->themeName . '/data_sample/' ;
		$this->bootstrap = true;
		$this->displayName = $this->l('Install Data Sample');
		$this->description = $this->l('Install Data Sample.');
	}

	public function install()
	{
	 	if (!parent::install() || !$this->registerHook('displayBackOfficeTop'))
	 		return false;

		//$return = $this->installDataSample();
	 	return true;
	}
	
	public function installTable()
	{
        if ( !file_exists( $this->sample_path.self::INSTALL_SQL_FILE ) )
			return (false);
		else if ( !$sql = file_get_contents( $this->sample_path.self::INSTALL_SQL_FILE) )
			return (false);

		$sql = str_replace('PREFIX_', _DB_PREFIX_, $sql);
		$sql = preg_split("/;\s*[\r\n]+/",$sql);
		foreach ($sql as $query)
		{
			if(!empty($query))
			{
				if (!Db::getInstance()->Execute(trim($query)))
					return (false);
			}
		}

        return true;
    }

	public function uninstall()
	{
	 	if (!parent::uninstall())
            return false;
		return true;
	}
	
	public function hookDisplayBackOfficeTop(){
		$activedTheme = Configuration::get("PTS_ACTIVEDTHEMEFREE");

		if( empty($activedTheme)  || $activedTheme != $this->themeName ) {
			$this->installDataSample();
			Configuration::updateValue( 'PTS_ACTIVEDTHEMEFREE', $this->themeName );
		}	
		return true;
	}

	public function installDataSample()
	{
		$xml = $this->getModuleSamples();
		if($xml)
		{
			foreach ($xml as $key => $value)
			{
				if( isset($value['images']) && isset($value['imgfolder']) )
				{

			 		$dst = _PS_MODULE_DIR_.$value['name'].'/'.trim($value['imgfolder']);

			 		$src = $this->sample_path.'images';
			 		if( !is_array($value['images']['image']) )
			 		{
			 			$value['images']['image'] = array($value['images']['image']);
			 		}
			 		if( is_dir($dst) && is_dir($src) )
			 		{
				 		foreach( $value['images']['image'] as $file )
				 		{
				 			if( !file_exists($dst.'/'.$file) )
				 			{
					 			if (is_readable($src.'/'.$file) && $file != 'Thumbs.db' && $file != '.DS_Store' && substr($file, -1) != '~')
					 			{
									if( copy($src.'/'.$file, $dst.'/'.$file) )
									{
										//@unlink( $src.'/'.$file );
									}
								}
					  		}
					 	}
					}
			 	}
			 	// Config update
			 	if( isset($value['configs']) )
			 	{
		        	foreach( $value['configs'] as $key => $value )
		        	{
		        		Configuration::updateValue( $key, $value, true );
		        	}
			 	}
			}
		}
		$res = true;
		$res = $this->installTable();

		return $res;
	}

	public function getContent()
	{
		$html = '';
		if( Tools::isSubmit('installDataSample') && Tools::getValue('import_data_sample') )
		{
			$res = $this->installDataSample();
			if($res)
			{
				$html .= $this->displayConfirmation($this->l('Data sample was installed successful.'));
			}
		}

		$fields_form[]['form'] = array(
			'legend' => array(
				'title' => $this->l('Import data dample'),
				
			),
			'desc' => 'If you import data sample, all datas will be removed. And data sample will be inserted.',
			'input' => array(
				array(
					'type' => 'switch',
					'label' => $this->l('Do you want import data sample?'),
					'name' => 'import_data_sample',
					'values' => array(
						array(
							'id' => 'active_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id' => 'active_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					),
				)
			),
			'submit' => array(
				'title' => $this->l('Install Data Sample'),
			)
		);


        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table =  $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'installDataSample';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => array('import_data_sample' => 0),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );

        return $html.$helper->generateForm( ($fields_form) );
	}

	public function getModuleSamples()
	{
	    $xml = $this->sample_path.'modules.xml';

	    $output = array();

	    if( file_exists($xml) )
	    {
	    	$info = simplexml_load_string( file_get_contents($xml) );
	    	$output = array();
	    
	    	if( empty($info) )
	    	{
	    		return $output;
	    	}

	    	foreach ($info->children() as $key=> $xmlModule)
	    	{
    			$a =   $vars = get_object_vars($xmlModule);
    		 	$m = array();
    			foreach ($a as $k => $f )
    			{
    				if( is_object($f) )
    				{
						$m[$k] =  get_object_vars( $f );
    				}else{
						$m[$k] = (string)$f;
    				}
    			}
    			$output[$m['name']] = $m;
	    	}
	    }

	    return $output;
	}

	

}



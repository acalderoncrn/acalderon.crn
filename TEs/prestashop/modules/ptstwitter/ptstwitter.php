<?php
/**
 * Pts Prestashop Theme Framework for Prestashop 1.6.x
 *
 * @package   ptstwitter
 * @version   0.9
 * @author    http://www.prestabrain.com
 * @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
 *               <info@prestabrain.com>.All rights reserved.
 * @license   GNU General Public License version 2
 */

if (!defined('_PS_VERSION_'))
	exit;

class PtsTwitter extends Module
{
	private $_html = '';
	private $_postErrors = array();
	public $isInstalled = false;

	public $_prefix;
	public $_fields_form = array();

	public function __construct()
	{
		$this->name = 'ptstwitter';
		$this->tab = 'front_office_features';
		$this->version = 0.9;
		$this->author = 'PrestaBrain';
		$this->need_instance = 0;

		$this->bootstrap = true;
		parent::__construct();	
		$this->_prefix = 'PTS_TWG';

		$this->displayName = $this->l('Pts Twitter Modules');
		$this->description = $this->l('This modules works with ptsblog module.');
	}

	public function install() {
		$hookspos = array(
            'displayTop',
            'displayHeaderRight',
            'displaySlideshow',
            'topNavigation',
			'displayMainmenu',
            'displayPromoteTop',
            'displayRightColumn',
            'displayLeftColumn',
            'displayHome',
            'displayFooter',
            'displayBottom',
            'displayContentBottom',
            'displayFootNav',
            'displayFooterTop',
            'displayFooterBottom'

        );
		
		foreach( $hookspos as $hook ){
			if( Hook::getIdByName($hook) ){
				
			} else {
				$new_hook = new Hook();
				$new_hook->name = pSQL($hook);
				$new_hook->title = pSQL($hook);
				$new_hook->add();
			}
		}
		
		if (!parent::install()
			|| !$this->registerHook('header')
			|| !$this->registerHook('displayFooterTop') )
			return false;
		$this->_clearBBCCache();
		return true;
	}

	public function uninstall() {
		if (!parent::uninstall()
			|| !$this->unregisterHook('displayFooterTop')
			|| !$this->unregisterHook('header') )
			return false;
		$this->makeFormConfig();
		$this->deleteConfigs();
		$this->_clearBBCCache();
		return true;
	}

	public function getContent() {
		$output = '<h2>' . $this->displayName . '</h2>';
		if (Tools::isSubmit('submitPtsTwitter')) {

			$this->makeFormConfig();
    		$this->batchUpdateConfigs();
    		
    		$this->_clearCache('ptsTwitter.tpl');
            $output .= $this->displayConfirmation($this->l('Settings updated successfully.'));
            $this->_clearBBCCache();
		}
		return $output . $this->renderForm();
	}

	public function makeFormConfig() {
		if( $this->_fields_form ){
            return ;
        }	
    	$soption = array(
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
        );
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Settings'),
					'icon' => 'icon-cogs'
				),
				'input' => array(
					   array(
	                    'type'  => 'text',
	                    'label' => $this->l('Twitter'),
	                    'name'  => 'twidget_id',
	                    'default'=> '366766896986591232',
	                    'desc' => 'Please go to the page https://twitter.com/settings/widgets/new, then create a widget, and get data-widget-id to input in this param.'
	                ),

	               	array(
	                    'type'  => 'text',
	                    'label' => $this->l('Count'),
	                    'name'  => 'count',
	                    'default'=> '2',
	                    'desc'=> 'If the param is empty or equal 0, the widget will show scrollbar when more items. Or you can input number from 1-20. Default NULL.'
	                ),
	               	
	               	array(
	                    'type'  => 'text',
	                    'label' => $this->l('User'),
	                    'name'  => 'username',
	                    'default'=> 'pavothemes',
	                ),
	               	 array(
	                    'type' => 'text',
	                    'label' => $this->l( 'Border Color' ),
	                    'name' => 'border_color',
	                    'default' => "",
    
                	 ),

                	array(
	                    'type'  => 'text',
	                    'label' => $this->l('Width'),
	                    'name'  => 'width',
	                    'default'=> '',
	                ),
	               	
	               	array(
	                    'type'  => 'text',
	                    'label' => $this->l('Height'),
	                    'name'  => 'height',
	                    'default'=> '',
	                ),
 
                	
                	array(
	                    'type' => 'switch',
	                    'label' => $this->l( 'Show Replies' ),
	                    'name' => 'show_replies',
	                    'values' => $soption,
	                    'default' => "1",
    
                	),


                	array(
	                    'type' => 'switch',
	                    'label' => $this->l( 'Show Header' ),
	                    'name' => 'show_header',
	                    'values' => $soption,
	                    'default' => "0",
    
                	),


                	array(
	                    'type' => 'switch',
	                    'label' => $this->l( 'Show Footer' ),
	                    'name' => 'show_footer',
	                    'values' => $soption,
	                    'default' => "0",
    
                	),


                	array(
	                    'type' => 'switch',
	                    'label' => $this->l( 'Show Border' ),
	                    'name' => 'show_border',
	                    'values' => $soption,
	                    'default' => "0",
    
                	),

                	array(
	                    'type' => 'switch',
	                    'label' => $this->l( 'Show Scrollbar' ),
	                    'name' => 'show_scrollbar',
	                    'values' => $soption,
	                    'default' => "1",
    
                	)
				),
				'submit' => array(
					'title' => $this->l('Save'),
					'class' => 'btn btn-default')
				),
		);
		$this->_fields_form[] = $fields_form;
	}

	public function renderForm() {

		$this->makeFormConfig();

		$helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table =  $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitPtsTwitter';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );

        return $helper->generateForm(($this->_fields_form));
	}

	public function getConfigFieldsValues() {

    	$languages = Language::getLanguages(false);
    	$fields_values = array();

    	foreach ( $this->_fields_form as $f ) {
    		foreach ( $f['form']['input'] as $input ) {
    			if( isset($input['lang']) ) {
    				foreach ( $languages as $lang ) {
    					$values = Tools::getValue( $input['name'].'_'.$lang['id_lang'], Configuration::get($this->renderName($input['name']), $lang['id_lang']) );
                        $fields_values[$input['name']][$lang['id_lang']] = $values ? $values : $input['default'];
    				}
    			}else {
    				$values = Tools::getValue( $input['name'], Configuration::get($this->renderName($input['name'])) );
    				$fields_values[$input['name']] = $values ? $values : $input['default'];
    			}
    		}
    	}
    
    	return $fields_values;
    }

    public function batchUpdateConfigs() {

    	$languages = Language::getLanguages(false);

    	foreach ( $this->_fields_form as $f ) {
    		foreach ( $f['form']['input'] as $input ) {
    			if( isset($input['lang']) ) {
                    $data = array();
    				foreach ( $languages as $lang ) {
                        $val = Tools::getValue( $input['name'].'_'.$lang['id_lang'], Configuration::get($this->renderName($input['name']).'_'.$lang['id_lang']) );
                        $data[$lang['id_lang']] = $val ? $val : $input['default'];
    				}
                    Configuration::updateValue( $this->renderName(trim($input['name'])), $data );
    			}else { 
    				$val = Tools::getValue( $input['name'], Configuration::get($this->renderName($input['name'])) );
    				Configuration::updateValue( $this->renderName($input['name']), $val ? $val : $input['default'] );
    			}
    		}
    	}

    }

    public function deleteConfigs() {

        $languages = Language::getLanguages(false);
        foreach ( $this->_fields_form as $f ) {
            foreach ( $f['form']['input'] as $input ) {
                if( isset($input['lang']) ) {
                    foreach ( $languages as $lang ) {
                        Configuration::deleteByName( $this->renderName($input['name'].'_'.$lang['id_lang']) );
                    }
                }else {
                    Configuration::deleteByName( $this->renderName($input['name']) );
                }
            }
        }

    }

    public function getConfigValue( $key, $value=null ) {
      return( Configuration::hasKey( $this->renderName($key) )?Configuration::get($this->renderName($key)) : $value );
    }
    
    public function renderName($name) {
        return strtoupper($this->_prefix.'_'.$name);
    }

    public function hookDisplayHome( $params ) {
		return $this->hookRightColumn( $params );
	}

	public function hookDisplayLeftColumn( $params  ) {
    	return $this->hookRightColumn( $params );
    }

    public function hookDisplayFooter( $params  ) {
    	return $this->hookRightColumn( $params );
    }


    public function hookDisplayPromoteTop( $params  ) {
    	return $this->hookRightColumn( $params );
    }

    public function hookDisplayContentBottom( $params  ) {
    	return $this->hookRightColumn( $params );
    }

    public function hookDisplayBottom( $params  ) {
    	return $this->hookRightColumn( $params );
    }

    public function hookDisplayFooterTop( $params  ) {
    	return $this->hookRightColumn( $params );
    }

     public function hookDisplayFooterBottom( $params ) {
    	return $this->hookRightColumn( $params );
    }

	public function hookRightColumn( $params ) {
		$setting  = array(
			'name'=> '',
			'twidget_id'   => '366766896986591232',
			'count'   	   => '2',
			'username'     => 'pavothemes',
			'theme'   	   => 'light',
			'border_color' => 'FFFFFF',
			'width'   	   => '',
			'height'   	   => '130',
			'show_replies'   => '1',

			'show_header'    => '0',
			'show_footer'    => '0',
			'show_border'    => '0',
			'show_scrollbar' => '1',
			'chrome' => ''
		);

		foreach( $setting as $key => $value ){
			$setting[$key] = $this->getConfigValue( $key, $value );
		}	
		$setting['js'] = '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
	 	
	  

		if( !$setting['show_header'] ){
			$setting['chrome'] .= 'noheader ';
		}
		if( !$setting['show_footer'] ){
			$setting['chrome'] .= 'nofooter ';
		}
		if( !$setting['show_border'] ){
			$setting['chrome'] .= 'noborders ';
		}
		if( !$setting['show_scrollbar'] ){
			$setting['chrome'] .= 'noscrollbar ';
		}


	 	$this->smarty->assign( $setting );

	 	return $this->display(__FILE__, 'ptstwitter.tpl');

  		return $output;
	}

	public function hookLeftColumn( $params ) {
		return $this->hookRightColumn($params);
	}
	
 
	public function _clearBBCCache(){
        $this->_clearCache('ptstwitter.tpl');
    }
	
}

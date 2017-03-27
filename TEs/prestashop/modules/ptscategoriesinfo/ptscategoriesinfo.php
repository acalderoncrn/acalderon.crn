<?php
/**
 * Pts Prestashop Theme Framework for Prestashop 1.6.x
 *
 * @package   ptscategoriesinfo
 * @version   1.0
 * @author    http://www.prestabrain.com
 * @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
 *               <info@prestabrain.com>.All rights reserved.
 * @license   GNU General Public License version 2
 */

if (!defined('_CAN_LOAD_FILES_'))
	exit;

include_once _PS_MODULE_DIR_.'ptscategoriesinfo/ptscategoriesinfoClass.php';

class ptscategoriesinfo extends Module
{
	private $_prefix;
	private $_fields_form = array();
	public function __construct()
	{
		$this->name = 'ptscategoriesinfo';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'PrestaBrain';

		$this->bootstrap = true;
		$this->_prefix = 'ptscatinfo';
		parent::__construct();	

		$this->displayName = $this->l('Pts Display Categories Information');
		$this->description = $this->l('Pts Display Categories Information.');
		$this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
	}

	public function install()
	{
		$return = parent::install() &&
			$this->installDB() &&
			$this->registerHook('displayTopColumn') && $this->registerHook('header') /* && $this->installFixtures() */
			&& $this->registerHook('addproduct')
			&& $this->registerHook('updateproduct')
			&& $this->registerHook('deleteproduct')
			&& $this->registerHook('categoryAddition')
			&& $this->registerHook('categoryUpdate')
			&& $this->registerHook('categoryDeletion');

		$hookspos = array(
            'displayTop',
            'displayHeaderRight',
            'displaySlideshow',
            'topNavigation',
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

        return $return;
	}
	
	public function installDB()
	{
		return true;
		$return = true;
		$return &= Db::getInstance()->execute('
			CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'ptscategoriesinfo` (
				`id_ptscategoriesinfo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				`id_shop` int(10) unsigned NOT NULL ,
				`id_category` int(10) unsigned NOT NULL ,
				`file_name` VARCHAR(100) NOT NULL,
				`addition_class` varchar(255) DEFAULT NULL,
				PRIMARY KEY (`id_ptscategoriesinfo`)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8 ;');
		
		$return &= Db::getInstance()->execute('
			CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'ptscategoriesinfo_lang` (
				`id_ptscategoriesinfo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				`id_lang` int(10) unsigned NOT NULL ,
				`text` VARCHAR(300) NOT NULL,
				`title` varchar(255) DEFAULT NULL,
				`prefix` varchar(255) DEFAULT NULL,
				PRIMARY KEY (`id_ptscategoriesinfo`, `id_lang`)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8 ;');
		
		return $return;
	}

	public function uninstall()
	{
		// Delete configuration
		return $this->uninstallDB() && parent::uninstall();
	}

	public function uninstallDB()
	{
		return Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'ptscategoriesinfo`') && Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'ptscategoriesinfo_lang`');
	}

	public function addToDB()
	{
		if (isset($_POST['nbblocks']))
		{
			for ($i = 1; $i <= (int)$_POST['nbblocks']; $i++)
			{
				$filename = explode('.', $_FILES['info'.$i.'_file']['name']);
				if (isset($_FILES['info'.$i.'_file']) && isset($_FILES['info'.$i.'_file']['tmp_name']) && !empty($_FILES['info'.$i.'_file']['tmp_name']))
				{
					if ($error = ImageManager::validateUpload($_FILES['info'.$i.'_file']))
						return false;
					elseif (!($tmpName = tempnam(_PS_TMP_IMG_DIR_, 'PS')) || !move_uploaded_file($_FILES['info'.$i.'_file']['tmp_name'], $tmpName))
						return false;
					elseif (!ImageManager::resize($tmpName, dirname(__FILE__).'/img/'.$filename[0].'.jpg'))
						return false;
					unlink($tmpName);
				}
				Db::getInstance()->execute('INSERT INTO `'._DB_PREFIX_.'ptscategoriesinfo` (`filename`,`text`)
											VALUES ("'.((isset($filename[0]) && $filename[0] != '') ? pSQL($filename[0]) : '').
					'", "'.((isset($_POST['info'.$i.'_text']) && $_POST['info'.$i.'_text'] != '') ? pSQL($_POST['info'.$i.'_text']) : '').'")');
			}
			return true;
		} else
			return false;
	}

	public function removeFromDB()
	{
		$dir = opendir(dirname(__FILE__).'/img');
		while (false !== ($file = readdir($dir)))
		{
			$path = dirname(__FILE__).'/img/'.$file;
			if ($file != '..' && $file != '.' && !is_dir($file))
				unlink($path);
		}
		closedir($dir);

		return Db::getInstance()->execute('DELETE FROM `'._DB_PREFIX_.'ptscategoriesinfo`');
	}

	public function getContent()
	{
		$html = '';
		$id_ptscategoriesinfo = (int)Tools::getValue('id_ptscategoriesinfo');
		if(Tools::isSubmit('saveConfig')) {
			$this->makeFormConfigs();
            $this->batchUpdateConfigs();
            Tools::redirectAdmin(AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
            $html .= $this->displayConfirmation($this->l('Settings updated successfully.'));
		}

		if(Tools::getIsset('deleteCatImage') && Tools::getValue('deleteCatImage')){
			$obj = new ptscategoriesinfoClass((int)(Tools::getValue('id_ptscategoriesinfo')));
			
			$image = dirname(__FILE__).'/img/'.$obj->file_name;
			@unlink($image);
		}

		if (Tools::isSubmit('saveptscategoriesinfo'))
		{
			if ($id_ptscategoriesinfo = Tools::getValue('id_ptscategoriesinfo'))
				$reinsurance = new ptscategoriesinfoClass((int)$id_ptscategoriesinfo);
			else
				$reinsurance = new ptscategoriesinfoClass();
			$reinsurance->copyFromPost();
			$reinsurance->id_shop = $this->context->shop->id;
			
			if ($reinsurance->validateFields(false) && $reinsurance->validateFieldsLang(false))
			{
				$reinsurance->save();
				if (isset($_FILES['image']) && isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name']))
				{
					if ($error = ImageManager::validateUpload($_FILES['image']))
						return false;
					elseif (!($tmpName = tempnam(_PS_TMP_IMG_DIR_, 'PS')) || !move_uploaded_file($_FILES['image']['tmp_name'], $tmpName))
						return false;
					elseif (!ImageManager::resize($tmpName, dirname(__FILE__).'/img/ptscatinfo-'.(int)$reinsurance->id.'-'.(int)$reinsurance->id_shop.'.jpg'))
						return false;
					unlink($tmpName);
					$reinsurance->file_name = 'ptscatinfo-'.(int)$reinsurance->id.'-'.(int)$reinsurance->id_shop.'.jpg';
					$reinsurance->save();
				}
				$this->clearCache();
			}
			else
				$html .= '<div class="conf error">'.$this->l('An error occurred while attempting to save.').'</div>';
		}
		
		if (Tools::isSubmit('updateptscategoriesinfo') || Tools::isSubmit('addptscategoriesinfo'))
		{
			$helper = $this->initForm();
            $reinsurance = new ptscategoriesinfoClass((int)$id_ptscategoriesinfo);
			foreach (Language::getLanguages(false) as $lang){
				if ($id_ptscategoriesinfo) {
					$helper->fields_value['text'][(int)$lang['id_lang']] = $reinsurance->text[(int)$lang['id_lang']];
					$helper->fields_value['title'][(int)$lang['id_lang']] = $reinsurance->title[(int)$lang['id_lang']];
					$helper->fields_value['prefix'][(int)$lang['id_lang']] = $reinsurance->prefix[(int)$lang['id_lang']];
				} else {
					$helper->fields_value['text'][(int)$lang['id_lang']] = Tools::getValue('text_'.(int)$lang['id_lang'], '');
					$helper->fields_value['title'][(int)$lang['id_lang']] = Tools::getValue('title_'.(int)$lang['id_lang'], '');
					$helper->fields_value['prefix'][(int)$lang['id_lang']] = Tools::getValue('prefix_'.(int)$lang['id_lang'], '');
                }
            }
            
			if ($id_ptscategoriesinfo = Tools::getValue('id_ptscategoriesinfo'))
			{
				$this->fields_form[0]['form']['input'][] = array('type' => 'hidden', 'name' => 'id_ptscategoriesinfo');
				$helper->fields_value['id_ptscategoriesinfo'] = (int)$id_ptscategoriesinfo;
 			}
			$helper->fields_value['addition_class'] = Tools::getValue('addition_class', $reinsurance->addition_class);
            $this->clearCache();
			return $html.$helper->generateForm($this->fields_form);
		}
		else if (Tools::isSubmit('deleteptscategoriesinfo'))
		{
			$reinsurance = new ptscategoriesinfoClass((int)$id_ptscategoriesinfo);
			if (file_exists(dirname(__FILE__).'/img/'.$reinsurance->file_name))
				unlink(dirname(__FILE__).'/img/'.$reinsurance->file_name);
			$reinsurance->delete();
			$this->clearCache();
			Tools::redirectAdmin(AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
		}
		else
		{
			$helper = $this->initList();
			return $html.$helper->generateList($this->getListContent((int)Configuration::get('PS_LANG_DEFAULT')), $this->fields_list).$this->renderForm();
		}

		if (isset($_POST['submitModule']))
		{
			$this->clearCache();
			Configuration::updateValue('ptscategoriesinfo_NBBLOCKS', ((isset($_POST['nbblocks']) && $_POST['nbblocks'] != '') ? (int)$_POST['nbblocks'] : ''));
			if ($this->removeFromDB() && $this->addToDB())
			{
				$this->_clearCache('ptscategoriesinfo.tpl');
				$output = '<div class="conf confirm">'.$this->l('The block configuration has been updated.').'</div>';
			}
			else
				$output = '<div class="conf error"><img src="../img/admin/disabled.gif"/>'.$this->l('An error occurred while attempting to save.').'</div>';
		}
	}

	protected function getListContent($id_lang)
	{
		return  Db::getInstance()->executeS('
			SELECT r.`id_ptscategoriesinfo`, r.`id_shop`, r.`id_category`, r.`file_name`, r.`addition_class`, rl.`text`, rl.`title`, rl.`prefix`, cl.name as category_title
			FROM `'._DB_PREFIX_.'ptscategoriesinfo` r
			LEFT JOIN `'._DB_PREFIX_.'ptscategoriesinfo_lang` rl ON (r.`id_ptscategoriesinfo` = rl.`id_ptscategoriesinfo`)
			LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (r.`id_category` = cl.`id_category` AND cl.`id_lang` = rl.`id_lang`)
			WHERE rl.`id_lang` = '.(int)$id_lang.' AND r.id_shop = '.(int)$this->context->shop->id);
	}

	protected function initForm()
	{
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');

		$obj = new ptscategoriesinfoClass((int)(Tools::getValue('id_ptscategoriesinfo')));
		$selected_categories = array($obj->id_category);

		$image = dirname(__FILE__).'/img/'.$obj->file_name;
		$image_url = is_file($image) ? ImageManager::thumbnail($image, $this->name.'_'.$obj->file_name, 350, '.jpg', true, true) : '';
		$image_size = file_exists($image) ? filesize($image) / 1000 : false;


		$this->fields_form[0]['form'] = array(
			'legend' => array(
				'title' => $this->l('New reassurance block'),
			),
			'input' => array(
				array(
					'type' => 'file',
					'label' => $this->l('Image'),
					'name' => 'image',
					'value' => true,
					'image' => $image_url ? $image_url : false,
					'size' => $image_size,
					'delete_url' => AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&id_ptscategoriesinfo='.$obj->id.'&deleteCatImage=1',
				),
				array(
					'type'  => 'categories',
					'label' => $this->l('Category'),
					'name'  => 'id_category',
					'tree'  => array(
						'id'                  => 'categories-tree',
						'selected_categories' => $selected_categories,
						'disabled_categories' => null
					)
				),
				array(
					'type' => 'text',
					'label' => $this->l('Prefix'),
					'lang' => true,
					'name' => 'prefix',
				),
				array(
					'type' => 'text',
					'label' => $this->l('Title'),
					'lang' => true,
					'name' => 'title',
				),
				array(
					'type' => 'textarea',
					'label' => $this->l('Text'),
					'lang' => true,
					'autoload_rte' => true,
					'name' => 'text',
					'cols' => 40,
					'rows' => 10
				),
                array(
					'type' => 'text',
					'label' => $this->l('Addition Class'),
					'name' => 'addition_class',
				),
			),
			'submit' => array(
				'title' => $this->l('Save'),
			)
		);

		$helper = new HelperForm();
		$helper->module = $this;
		$helper->name_controller = 'ptscategoriesinfo';
		$helper->identifier = $this->identifier;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		foreach (Language::getLanguages(false) as $lang)
			$helper->languages[] = array(
				'id_lang' => $lang['id_lang'],
				'iso_code' => $lang['iso_code'],
				'name' => $lang['name'],
				'is_default' => ($default_lang == $lang['id_lang'] ? 1 : 0)
			);

		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		$helper->default_form_language = $default_lang;
		$helper->allow_employee_form_lang = $default_lang;
		$helper->toolbar_scroll = true;
		$helper->title = $this->displayName;
		$helper->submit_action = 'saveptscategoriesinfo';
		$helper->toolbar_btn =  array(
			'save' =>
			array(
				'desc' => $this->l('Save'),
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'back' =>
			array(
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
				'desc' => $this->l('Back to list')
			)
		);
		return $helper;
	}

	protected function initList()
	{
		$this->fields_list = array(
			'id_ptscategoriesinfo' => array(
				'title' => $this->l('ID'),
				'width' => 120,
				'type' => 'text',
				'search' => false,
				'orderby' => false
			),
			'title' => array(
				'title' => $this->l('Title'),
				'width' => 140,
				'type' => 'text',
				'search' => false,
				'orderby' => false
			),
			'category_title' => array(
				'title' => $this->l('Category'),
				'width' => 140,
				'type' => 'text',
				'search' => false,
				'orderby' => false
			),
		);

		if (Shop::isFeatureActive())
			$this->fields_list['id_shop'] = array('title' => $this->l('ID Shop'), 'align' => 'center', 'width' => 25, 'type' => 'int');

		$helper = new HelperList();
		$helper->shopLinkType = '';
		$helper->simple_header = false;
		$helper->identifier = 'id_ptscategoriesinfo';
		$helper->actions = array('edit', 'delete');
		$helper->show_toolbar = true;
		$helper->imageType = 'jpg';
		$helper->toolbar_btn['new'] =  array(
			'href' => AdminController::$currentIndex.'&configure='.$this->name.'&add'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
			'desc' => $this->l('Add new')
		);

		$helper->title = $this->displayName;
		$helper->table = $this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		return $helper;
	}
    
    protected function makeFormConfigs()
	{
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
		$obj = new ptscategoriesinfoClass((int)(Tools::getValue('id_ptscategoriesinfo')));
		$selected_categories = array($obj->id_category);

		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Setting'),
					'icon' => 'icon-cogs'
				),
				'input' => array(
					array(
						'type' => 'switch',
						'label' => $this->l('Show banner'),
						'name' => $this->renderName('show_banner'),
						'is_bool' => true,
						'values' => array(
							array(
								'id' => 'nb_products_on',
								'value' => 1,
								'label' => $this->l('Enabled')
							),
							array(
								'id' => 'nb_products_off',
								'value' => 0,
								'label' => $this->l('Disabled')
							)
						),
						'default' => 1
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Show Number Products'),
						'name' => $this->renderName('nb_products'),
						'is_bool' => true,
						'values' => array(
							array(
								'id' => 'nb_products_on',
								'value' => 1,
								'label' => $this->l('Enabled')
							),
							array(
								'id' => 'nb_products_off',
								'value' => 0,
								'label' => $this->l('Disabled')
							)
						),
						'default' => 1
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Show Description'),
						'name' => $this->renderName('show_des'),
						'is_bool' => true,
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
						'default' => 0
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Show Subcategories'),
						'name' => $this->renderName('show_subcategory'),
						'is_bool' => true,
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
						'default' => 0
					),
					array(
                        'type' => 'text',
                        'label' => $this->l('Number sub category'),
                        'name' => $this->renderName('nb_subcategory'),
                        'desc' => $this->l('The maximum number of sub categories in each page tab (default: 4)'),
                        'default' => '4',
                    ),
				),
				'submit' => array(
					'title' => $this->l('Save'),
				)
			)
		);

		$this->_fields_form[] = $fields_form;
	}

	public function renderForm() {
        $this->makeFormConfigs();

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table =  $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'saveConfig';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );

        return $helper->generateForm( ($this->_fields_form) );
    }

    public function getConfigFieldsValues() {
        $fields_values = array();

        foreach ( $this->_fields_form as $f ) {
            foreach ( $f['form']['input'] as $input ) {
                if( isset($input['lang']) ) {
                    foreach ( $this->languages() as $lang ) {
                        $values = Tools::getValue( $input['name'].'_'.$lang['id_lang'], ( Configuration::hasKey($input['name'], $this->context->language->id) ? Configuration::get($input['name'], $lang['id_lang']) : $input['default'] ) );
                        $fields_values[$input['name']][$lang['id_lang']] = $values;
                    }
                }else {
                    $values = Tools::getValue( $input['name'], ( Configuration::hasKey($input['name']) ? Configuration::get($input['name']) : $input['default'] ) );
                    $fields_values[$input['name']] = $values;
                }
            }
        }

        return $fields_values;
    }

    public function batchUpdateConfigs() {

        foreach ( $this->_fields_form as $f ) {
            foreach ( $f['form']['input'] as $input ) {
                if( isset($input['lang']) ) {
                    $data = array();
                    foreach ( $this->languages() as $lang ) {
                        $val = Tools::getValue( $input['name'].'_'.$lang['id_lang'], $input['default'] );
                        $data[$lang['id_lang']] = $val;
                    }
                    Configuration::updateValue( trim($input['name']), $data );
                }else { 
                    $val = Tools::getValue( $input['name'], $input['default'] );
                    Configuration::updateValue( $input['name'], $val );
                }
            }
        }

    }

    public function deleteConfigs() {

        foreach ( $this->_fields_form as $f ) {
            foreach ( $f['form']['input'] as $input ) {
                if( isset($input['lang']) ) {
                    foreach ( $this->languages() as $lang ) {
                        Configuration::deleteByName( $input['name'].'_'.$lang['id_lang'] );
                    }
                }else {
                    Configuration::deleteByName( $input['name'] );
                }
            }
        }

    }

    public function getConfigValue( $key, $value=null ){
      return( Configuration::hasKey( $this->renderName($key) )?Configuration::get($this->renderName($key)) : $value );
    }

    public function renderName($name){
        return strtoupper($this->_prefix.'_'.$name);
    }

    public function languages(){
        return Language::getLanguages(false);
    }

    public function hookHeader(){
        $this->context->controller->addCSS($this->_path.'style.css', 'all');
    }
    
	public function hookDisplayFooter($params)
	{
		if (!$this->isCached('ptscategoriesinfo.tpl', $this->getCacheId()))
		{
			$infos = $this->getListContent($this->context->language->id);
			if($this->getConfigValue('nb_products')) {
				foreach ($infos as &$value) {
					$catgory = new Category((int)($value['id_category']));
					$value['nb_products'] = $catgory->getProducts($this->context->language->id, 0, 1, null, null, true);
					$value['subcategories'] = $this->getSubCategories($value['id_category'], $this->getConfigValue('nb_subcategory', 4), $this->context->language->id);
				}
			}
			$this->context->smarty->assign(
				array('infos' => $infos, 'nbblocks' => count($infos),
				'nb_products' => $this->getConfigValue('nb_products', 1), 
				'show_des' => $this->getConfigValue('show_des', 0),
				'show_subcategory' => $this->getConfigValue('show_subcategory', 0),
				'show_banner' => $this->getConfigValue('show_banner', 1)
				)
			);
		}
		return $this->display(__FILE__, 'ptscategoriesinfo.tpl', $this->getCacheId());
	}
	public function hookDisplayHome($params) {
        return $this->hookDisplayFooter($params);
    }

    public function hookDisplaySlideshow($params) {
        return $this->hookDisplayFooter($params);
    }

    public function hookDisplayPromoteTop($params) {
        return $this->hookDisplayFooter($params);
    } 
	
	public function hookDisplayTopColumn($params) {
        return $this->hookDisplayFooter($params);
    }

    public function hookDisplayBottom($params) {
        return $this->hookDisplayFooter($params);
    }

    public function hookDisplayContentBottom($params) {
        return $this->hookDisplayFooter($params);
    }

	public function installFixtures()
	{
		$return = true;
		$tab_texts = array(
			array('addition_class' => '', 'title' => $this->l('Money back guarantee.'), 'text' => '', 'file_name' => 'ptscatinfo-1-1.jpg', 'prefix' => 'For'),
			array('addition_class' => '', 'title' => $this->l('In-store exchange.'), 'text' => '', 'file_name' => 'ptscatinfo-2-1.jpg', 'prefix' => 'For'),
			array('addition_class' => '', 'title' => $this->l('Payment upon shipment.'), 'text' => '', 'file_name' => 'ptscatinfo-3-1.jpg', 'prefix' => 'For')
		);
		
		foreach($tab_texts as $tab)
		{
			$reinsurance = new ptscategoriesinfoClass();
			foreach (Language::getLanguages(false) as $lang){
				$reinsurance->text[$lang['id_lang']] = $tab['text'];
				$reinsurance->title[$lang['id_lang']] = $tab['title'];
				$reinsurance->prefix[$lang['id_lang']] = $tab['prefix'];
			}
			$reinsurance->file_name = $tab['file_name'];
			$reinsurance->addition_class = $tab['addition_class'];
			$reinsurance->id_shop = $this->context->shop->id;
			$reinsurance->id_category = $this->context->shop->getCategory();
			$return &= $reinsurance->save();
		}
		return $return;
	}

	public function getSubCategories($id_category, $nb = 5, $id_lang, $active = true)
	{
		$sql_groups_where = '';
		$sql_groups_join = '';
		if (Group::isFeatureActive())
		{
			$sql_groups_join = 'LEFT JOIN `'._DB_PREFIX_.'category_group` cg ON (cg.`id_category` = c.`id_category`)';
			$groups = FrontController::getCurrentCustomerGroups();
			$sql_groups_where = 'AND cg.`id_group` '.(count($groups) ? 'IN ('.implode(',', $groups).')' : '='.(int)Group::getCurrent()->id);
		}

		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
		SELECT c.*, cl.id_lang, cl.name, cl.description, cl.link_rewrite, cl.meta_title, cl.meta_keywords, cl.meta_description
		FROM `'._DB_PREFIX_.'category` c
		'.Shop::addSqlAssociation('category', 'c').'
		LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND `id_lang` = '.(int)$id_lang.' '.Shop::addSqlRestrictionOnLang('cl').')
		'.$sql_groups_join.'
		WHERE `id_parent` = '.(int)$id_category.'
		'.($active ? 'AND `active` = 1' : '').'
		'.$sql_groups_where.'
		GROUP BY c.`id_category`
		ORDER BY `level_depth` ASC, category_shop.`position` ASC
		LIMIT 0,'.(int)$nb );

		foreach ($result as &$row)
		{
			$row['id_image'] = Tools::file_exists_cache(_PS_CAT_IMG_DIR_.$row['id_category'].'.jpg') ? (int)$row['id_category'] : Language::getIsoById($id_lang).'-default';
			$row['legend'] = 'no picture';
		}
		return $result;
	}

	public function clearCache() { 
        $this->_clearCache( '*' );
    }

    public function hookAddProduct($params)
	{
		$this->_clearCache('*');
	}

	public function hookUpdateProduct($params)
	{
		$this->_clearCache('*');
	}

	public function hookDeleteProduct($params)
	{
		$this->_clearCache('*');
	}

	public function hookCategoryAddition($params)
	{
		$this->_clearCache('*');
	}

	public function hookCategoryUpdate($params)
	{
		$this->_clearCache('*');
	}

	public function hookCategoryDeletion($params)
	{
		$this->_clearCache('*');
	}
}

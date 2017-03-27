<?php
/**
 * Pts Prestashop Theme Framework for Prestashop 1.6.x
 *
 * @package   ptstoprating
 * @version   1.2
 * @author    http://www.prestabrain.com
 * @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
 *               <info@prestabrain.com>.All rights reserved.
 * @license   GNU General Public License version 2
 */

if (!defined('_PS_VERSION_'))
    exit;

class PtsTopRating extends Module {
	private $_prefix;
    private $_fields_form = array();

	function __construct() {
        $this->name = 'ptstoprating';
        $this->tab = 'pricing_promotion';
        $this->version = '1.2';
        $this->author = 'PrestaBrain';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->_prefix = 'ptstoprate';
        $this->displayName = $this->l('Pts top rating products');
        $this->description = $this->l('Display top rating products.');        
    }

    public function install() {
    	if( !parent::install()
    		|| !$this->registerHook('displayHome')
    	 )
    		return false;
    	return true;
    }

    public function uninstall() {
    	if( !parent::uninstall()
    		|| !$this->unregisterHook('displayHome')
    	 )
    		return false;
        $this->makeFormConfig();
        $this->deleteConfigs();
        
    	return true;
    }

    public function getContent() {
    	$output = '<h2>' . $this->displayName . '</h2>';
    	if ( Tools::isSubmit('submitPtsBlockCategoriesTabs') && Tools::isSubmit($this->renderName('itemstab')) ) {
    		$this->makeFormConfig();
    		$this->batchUpdateConfigs();
    	}
    	return $output . $this->renderForm();
    }

    public function makeFormConfig(){
        
    	$fields_form = array(
        	'form' => array(
        		'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs'
                ),

                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Items Per Page'),
                        'name' => $this->renderName('itemspage'),
                        'desc' => $this->l('The maximum number of products in each page tab (default: 3)'),
                        'default' => '3',
                        //'lang' => true
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Colums In Tab'),
                        'name' => $this->renderName('columns'),
                        'desc' => $this->l('The maximum number of products in each page tab (default: 3)'),
                        'default' => '3',
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Items In Tab'),
                        'name' => $this->renderName('itemstab'),
                        'desc' => $this->l('The maximum number of products in each tab (default: 6).'),
                        'default' => '6',
                    ),
            	),

                'submit' => array(
	                'title' => $this->l('Save'),
	                'class' => 'btn btn-default'
                )
        	),
    	);
		$this->_fields_form = array($fields_form);

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
        $helper->submit_action = 'submitPtsBlockCategoriesTabs';
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
        $fields_values = array();

        foreach ( $this->_fields_form as $f ) {
            foreach ( $f['form']['input'] as $input ) {
                if( isset($input['lang']) ) {
                    foreach ( $this->languages() as $lang ) {
                        $values = Tools::getValue( $input['name'].'_'.$lang['id_lang'], ( Configuration::hasKey($input['name']) ? Configuration::get($input['name'], $lang['id_lang']) : $input['default'] ) );
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
        $languages = Language::getLanguages(false);
        foreach ( $this->_fields_form as $f ) {
            foreach ( $f['form']['input'] as $input ) {
                if( isset($input['lang']) ) {
                    foreach ( $languages as $lang ) {
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

    public function hookDisplayHome($params) {
        return $this->hookRightColumn($params);
    }

    public function hookDisplayFooter($params) {
        return $this->hookRightColumn($params);
    }

    public function hookDisplaySlideshow($params) {
        return $this->hookRightColumn($params);
    }

    public function hookDisplayPromoteTop($params) {
        return $this->hookRightColumn($params);
    }

    public function hookDisplayBottom($params) {
        return $this->hookRightColumn($params);
    }
	
	public function hookDisplayFooterProduct($params) {
        return $this->hookRightColumn($params);
    }

    public function hookDisplayContentBottom($params) {
        return $this->hookRightColumn($params);
    }

    public function hookRightColumn($params) {
        $obj = Module::getInstanceByName('productcomments');
        if(!Validate::isLoadedObject($obj) || !$obj->id || !$obj->active)
            return;
        $nb = (int) $this->getConfigValue('itemstab');
        $items_page = (int) $this->getConfigValue('itemspage', 3);
        $columns_page = (int) $this->getConfigValue('columns', 3);
        
        $products = self::getProducts(1, $nb);
        Hook::exec('actionProductListModifier', array(
            'cat_products' => &$products,
        ));
        $this->smarty->assign(array(
            'itemsperpage' => $items_page,
            'columnspage' => $columns_page,
            'ptstoprate' => $products,
            'scolumn' => 12 / $columns_page,
            'mediumSize' => Image::getSize(ImageType::getFormatedName('medium')),
            'homeSize' => Image::getSize(ImageType::getFormatedName('home')),
        ));
        
        return $this->display(__FILE__, 'ptstoprating.tpl');
    }

    public function hookLeftColumn($params) {
        return $this->hookRightColumn($params);
    }

    public function hookHeader($params) {
        $this->context->controller->addCSS(($this->_path) . 'ptstoprating.css', 'all');
    }
    
    public static function getProducts($p = 1, $n, $active = true, Context $context = null)
    {
        if (!$context)
            $context = Context::getContext();
        $id_lang = $context->language->id;

        $front = true;
        if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
            $front = false;

        if ($p < 1) $p = 1;

        $id_supplier = (int)Tools::getValue('id_supplier');

        $sql = 'SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, MAX(product_attribute_shop.id_product_attribute) id_product_attribute, product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity, pl.`description`, pl.`description_short`, pl.`available_now`,
                pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, MAX(image_shop.`id_image`) id_image,
                il.`legend`, m.`name` AS manufacturer_name, cl.`name` AS category_default,
                DATEDIFF(product_shop.`date_add`, DATE_SUB(NOW(),
                INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).'
                    DAY)) > 0 AS new, product_shop.price AS orderprice, AVG(pc.grade) as avg_grade
            FROM `'._DB_PREFIX_.'category_product` cp
            LEFT JOIN `'._DB_PREFIX_.'product` p
                ON p.`id_product` = cp.`id_product`
            '.Shop::addSqlAssociation('product', 'p').'
            LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa
            ON (p.`id_product` = pa.`id_product`)
            '.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
            '.Product::sqlStock('p', 'product_attribute_shop', false, $context->shop).'
            LEFT JOIN `'._DB_PREFIX_.'category_lang` cl
                ON (product_shop.`id_category_default` = cl.`id_category`
                AND cl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('cl').')
            LEFT JOIN `'._DB_PREFIX_.'product_lang` pl
                ON (p.`id_product` = pl.`id_product`
                AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').')
            LEFT JOIN `'._DB_PREFIX_.'image` i
                ON (i.`id_product` = p.`id_product`)'.
            Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
            LEFT JOIN `'._DB_PREFIX_.'image_lang` il
                ON (image_shop.`id_image` = il.`id_image`
                AND il.`id_lang` = '.(int)$id_lang.')
            LEFT JOIN `'._DB_PREFIX_.'manufacturer` m
                ON m.`id_manufacturer` = p.`id_manufacturer`
            JOIN `'._DB_PREFIX_.'product_comment` pc ON (cp.id_product = pc.id_product)
            
            WHERE product_shop.`id_shop` = '.(int)$context->shop->id
            .($active ? ' AND product_shop.`active` = 1' : '')
            .($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '')
            .($id_supplier ? ' AND p.id_supplier = '.(int)$id_supplier : '')
            .' GROUP BY product_shop.id_product';

        $sql .= ' ORDER BY avg_grade DESC ';
        $sql .=' LIMIT '.(((int)$p - 1) * (int)$n).','.(int)$n;
        
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if (!$result)
            return array();
        /* Modify SQL result */
        return Product::getProductsProperties($id_lang, $result);
    }
        
}
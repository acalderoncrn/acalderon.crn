<?php
/**
 * Pts Prestashop Theme Framework for Prestashop 1.6.x
 *
 * @package   ptsblockprodcarousel
 * @version   5.0
 * @author    http://www.prestabrain.com
 * @copyright Copyright (C) October 2013 prestabrain.com <@emai:prestabrain@gmail.com>
 *               <info@prestabrain.com>.All rights reserved.
 * @license   GNU General Public License version 2
 */

if (!defined('_PS_VERSION_'))
    exit;

class PtsBlockProdCarousel extends Module {

    private $_prefix;
    private $_fields_form = array();

    public function __construct() {
        $this->name = 'ptsblockprodcarousel';
        $this->tab = 'pricing_promotion';
        $this->version = '2.0';
        $this->author = 'PrestaBrain';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();
        $this->_prefix = 'ptsprocar';

        $this->displayName = $this->l('Pts Products Carousel Block');
        $this->description = $this->l('Display Products of Categories in Carousel.');
    }

    public function install() {
        $a = (parent::install() AND $this->registerHook('home') AND $this->registerHook('header'));
        $this->_clearBLHLCache();

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

        
        return $a;
    }

    public function uninstall() {
        $this->makeFormConfig();
        $this->deleteConfigs();
        $this->_clearBLHLCache();
        return parent::uninstall();
    }

    public function getContent() {
        $output = '<h2>' . $this->displayName . '</h2>';
        if ( Tools::isSubmit('submitPtsBlockProdCarousel') && Tools::isSubmit($this->renderName('itemstab')) ) {

            $this->makeFormConfig();
            $this->batchUpdateConfigs();

            $categories = Tools::getValue('categoryBox');
            Configuration::updateValue($this->renderName('catids'), ($categories ? implode(',', $categories) : ''));

            $this->_clearCache('ptsblockprodcarousel.tpl');
            $output .= $this->displayConfirmation($this->l('Settings updated successfully.'));
            $this->_clearBLHLCache();

        }
        return $output . $this->renderForm();
    }

    public function makeFormConfig() {
        if( $this->_fields_form ){
            return ;
        }

        $orders = array(
            0 => array('value' => 'date_add', 'name' => $this->l('Date Add')),
            1 => array('value' => 'date_add DESC', 'name' => $this->l('Date Add DESC')),
            2 => array('value' => 'name', 'name' => $this->l('Name')),
            3 => array('value' => 'name DESC', 'name' => $this->l('Name DESC')),
            4 => array('value' => 'quantity', 'name' => $this->l('Quantity')),
            5 => array('value' => 'quantity DESC', 'name' => $this->l('Quantity DESC')),
            6 => array('value' => 'price', 'name' => $this->l('Price')),
            7 => array('value' => 'price DESC', 'name' => $this->l('Price DESC')));

        $selected_cat = Tools::getValue($this->renderName('catids'), Configuration::get($this->renderName('catids')));
        $categories = explode(',', $selected_cat);
        $root = Category::getRootCategory();

        $tree = new HelperTreeCategories('associated-categories-tree', 'Associated categories');
        $tree->setRootCategory($root->id)
            ->setUseCheckBox(true)
            ->setUseSearch(true)
            ->setSelectedCategories($categories);
        $category_tpl = $tree->render();

        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs'
                ),

                'input' => array(
                    array(
                        'type'  => 'categories_select',
                        'label' => $this->l('Categories:'),
                        'name'  => $this->renderName('catids'),
                        'category_tree'  =>  $category_tpl,
                        'default' => '1,2,3',
                    ),

                    array(
                        'type' => 'select',
                        'label' => $this->l('Order By'),
                        'name' => $this->renderName('porder'),
                        'options' => array(
                            'query' => $orders,
                            'id' => 'value',
                            'name' => 'name'
                        ),
                        'default' => 'date_add',
                    ),

                    array(
                        'type' => 'text',
                        'label' => $this->l('Items Per Page'),
                        'name' => $this->renderName('itemspage'),
                        'desc' => $this->l('The maximum number of products in each page tab (default: 6)'),
                        'default' => '6',
                    ),

                    array(
                        'type' => 'text',
                        'label' => $this->l('Colums In Tab'),
                        'name' => $this->renderName('columns'),
                        'desc' => $this->l('The maximum number of products in each page tab (default: 6)'),
                        'default' => '6',
                    ),

                    array(
                        'type' => 'text',
                        'label' => $this->l('Items In Tab'),
                        'name' => $this->renderName('itemstab'),
                        'desc' => $this->l('The maximum number of products in each tab (default: 12).'),
                        'default' => '12',
                    ),
                    
                    array(
                        'type' => 'text',
                        'label' => $this->l('Interval'),
                        'name' => $this->renderName('interval'),
                        'desc' => $this->l('Enter Time(miniseconds) to play carousel. Value 0 to stop.'),
                        'default' => '0',
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
        $helper->submit_action = 'submitPtsBlockProdCarousel';
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
                        $values = Tools::getValue( $input['name'].'_'.$lang['id_lang'], ( Configuration::hasKey($input['name']) ? Configuration::get($input['name'], $lang['id_lang']) : $input['default'] ) );
                        $fields_values[$input['name']][$lang['id_lang']] = $values;
                    }
                } else {
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
        return Tools::strtoupper($this->_prefix.'_'.$name);
    }

    public function languages(){
        return Language::getLanguages(false);
    }

    public function hookHeader($params) {
        $this->context->controller->addCSS(($this->_path) . 'ptsblockprodcarousel.css', 'all');
    }
    public function hookDisplayHome($params) {
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
    
    public function hookDisplayTopColumn($params) {
        return $this->hookRightColumn($params);
    }
	
	
    public function hookDisplayContentBottom($params) {
        return $this->hookRightColumn($params);
    }

    public function hookRightColumn($params) {
        if (!$this->isCached('ptsblockprodcarousel.tpl', $this->getCacheId())) {

            $nb = (int) $this->getConfigValue('itemstab',12);

            $catids = $this->getConfigValue('catids', '1,2,3');
            $catids = explode(",", $catids);
            $porder = $this->getConfigValue('porder', 'date_add');
            $porder = preg_split("#\s+#", $porder);
            if (!isset($porder[1])) {
                $porder[1] = null;
            }


            $items_page = (int) $this->getConfigValue('itemspage', 6);
            $columns_page = (int) $this->getConfigValue('columns', 6);


            $this->catids = $catids;
            $products = $this->getProducts((int) Context::getContext()->language->id, 1, $nb, $porder[0], $porder[1]);
            Hook::exec('actionProductListModifier', array(
                'cat_products' => &$products,
            ));

            $dir = dirname(__FILE__) . "/products.tpl";
            $tdir = _PS_ALL_THEMES_DIR_ . _THEME_NAME_ . '/modules/' . $this->name . '/products.tpl';

            if (file_exists($tdir)) {
                $dir = $tdir;
            }

            $this->smarty->assign(array(
                'itemsperpage' => $items_page,
                'columnspage'  => $columns_page,
                'product_tpl'  => $dir,
                'products'     => $products,
                'scolumn'      => 12 / $columns_page,
                'interval'     => (int)$this->getConfigValue( 'interval', 0 )
            ));
        }
        
        
        return $this->display(__FILE__, 'ptsblockprodcarousel.tpl', $this->getCacheId());
    }

    /**
     * Return current category products
     *
     * @param integer $id_lang Language ID
     * @param integer $p Page number
     * @param integer $n Number of products per page
     * @param boolean $get_total return the number of results instead of the results themself
     * @param boolean $active return only active products
     * @param boolean $random active a random filter for returned products
     * @param int $random_number_products number of products to return if random is activated
     * @param boolean $check_access set to false to return all products (even if customer hasn't access)
     * @return mixed Products or number of products
     */
    public function getProducts($id_lang, $p, $n, $order_by = null, $order_way = null, $get_total = false, $active = true, $random = false, $random_number_products = 1, Context $context = null) {
        if (!$context)
            $context = Context::getContext();


        $front = true;
        if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
            $front = false;

        if ($p < 1)
            $p = 1;

        if (empty($order_by))
            $order_by = 'position';
        else
        /* Fix for all modules which are now using lowercase values for 'orderBy' parameter */
            $order_by = Tools::strtolower($order_by);

        if (empty($order_way))
            $order_way = 'ASC';
        if ($order_by == 'id_product' || $order_by == 'date_add' || $order_by == 'date_upd')
            $order_by_prefix = 'p';
        elseif ($order_by == 'name')
            $order_by_prefix = 'pl';
        elseif ($order_by == 'manufacturer') {
            $order_by_prefix = 'm';
            $order_by = 'name';
        } elseif ($order_by == 'position')
            $order_by_prefix = 'cp';

        if ($order_by == 'price')
            $order_by = 'orderprice';

        if (!Validate::isBool($active) || !Validate::isOrderBy($order_by) || !Validate::isOrderWay($order_way))
            die(Tools::displayError());

        $id_supplier = (int) Tools::getValue('id_supplier');

        /* Return only the number of products */
        if ($get_total) {
            $sql = 'SELECT COUNT(cp.`id_product`) AS total
                    FROM `' . _DB_PREFIX_ . 'product` p
                    ' . Shop::addSqlAssociation('product', 'p') . '
                    LEFT JOIN `' . _DB_PREFIX_ . 'category_product` cp ON p.`id_product` = cp.`id_product`
                    WHERE cp.`id_category` IN("' . implode('","', $this->catids) . '") ' .
                    ($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '') .
                    ($active ? ' AND product_shop.`active` = 1' : '') .
                    ($id_supplier ? 'AND p.id_supplier = ' . (int) $id_supplier : '');
            return (int) Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        }

        $sql = 'SELECT DISTINCT p.id_product, p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, product_attribute_shop.`id_product_attribute`, product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity, pl.`description`, pl.`description_short`, pl.`available_now`,
                    pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, image_shop.`id_image`,
                    il.`legend`, m.`name` AS manufacturer_name, cl.`name` AS category_default,
                    DATEDIFF(product_shop.`date_add`, DATE_SUB(NOW(),
                    INTERVAL ' . (Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20) . '
                        DAY)) > 0 AS new, product_shop.price AS orderprice
                FROM `' . _DB_PREFIX_ . 'category_product` cp
                LEFT JOIN `' . _DB_PREFIX_ . 'product` p
                    ON p.`id_product` = cp.`id_product`
                ' . Shop::addSqlAssociation('product', 'p') . '
                LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute` pa
                ON (p.`id_product` = pa.`id_product`)
                ' . Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1') . '
                ' . Product::sqlStock('p', 'product_attribute_shop', false, $context->shop) . '
                LEFT JOIN `' . _DB_PREFIX_ . 'category_lang` cl
                    ON (product_shop.`id_category_default` = cl.`id_category`
                    AND cl.`id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('cl') . ')
                LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl
                    ON (p.`id_product` = pl.`id_product`
                    AND pl.`id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('pl') . ')
                LEFT JOIN `' . _DB_PREFIX_ . 'image` i
                    ON (i.`id_product` = p.`id_product`)' .
                Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1') . '
                LEFT JOIN `' . _DB_PREFIX_ . 'image_lang` il
                    ON (image_shop.`id_image` = il.`id_image`
                    AND il.`id_lang` = ' . (int) $id_lang . ')
                LEFT JOIN `' . _DB_PREFIX_ . 'manufacturer` m
                    ON m.`id_manufacturer` = p.`id_manufacturer`
                WHERE product_shop.`id_shop` = ' . (int) $context->shop->id . '
                AND (pa.id_product_attribute IS NULL OR product_attribute_shop.id_shop=' . (int) $context->shop->id . ') 
                AND (i.id_image IS NULL OR image_shop.id_shop=' . (int) $context->shop->id . ')
                    AND cp.`id_category` IN("' . implode('","', $this->catids) . '") '
                . ($active ? ' AND product_shop.`active` = 1' : '')
                . ($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '')
                . ($id_supplier ? ' AND p.id_supplier = ' . (int) $id_supplier : '');

        if ($random === true) {
            $sql .= ' ORDER BY RAND()';
            $sql .= ' LIMIT 0, ' . (int) $random_number_products;
        }
        else
            $sql .= ' ORDER BY ' . (isset($order_by_prefix) ? $order_by_prefix . '.' : '') . '`' . pSQL($order_by) . '` ' . pSQL($order_way) . '
            LIMIT ' . (((int) $p - 1) * (int) $n) . ',' . (int) $n;

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if ($order_by == 'orderprice')
            Tools::orderbyPrice($result, $order_way);

        if (!$result)
            return array();

        /* Modify SQL result */
        return Product::getProductsProperties($id_lang, $result);
    }

    public function hookLeftColumn($params) {
        return $this->hookRightColumn($params);
    }

    protected function getCacheId($name = null, $hook = '') {
        $cache_array = array(
            $name !== null ? $name : $this->name,
            $hook,
            date('Ymd'),
            (int) Tools::usingSecureMode(),
            (int) $this->context->shop->id,
            (int) Group::getCurrent()->id,
            (int) $this->context->language->id,
            (int) $this->context->currency->id,
            (int) $this->context->country->id
        );
        return implode('|', $cache_array);
    }

    public function _clearBLHLCache() {
        $this->_clearCache('ptsblockprodcarousel.tpl');
        $this->_clearCache('products.tpl');
    }
    
    public function hookAddProduct($params) {
        $this->_clearBLHLCache();
    }

    public function hookUpdateProduct($params) {
        $this->_clearBLHLCache();
    }

    public function hookDeleteProduct($params) {
        $this->_clearBLHLCache();
    }

}
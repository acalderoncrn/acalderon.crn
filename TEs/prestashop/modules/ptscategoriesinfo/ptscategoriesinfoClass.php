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

class ptscategoriesinfoClass extends ObjectModel
{
	/** @var integer reinsurance id*/
	public $id;
	
	/** @var integer reinsurance id shop*/
	public $id_shop;
	public $id_category;
	
	/** @var string reinsurance file name icon*/
	public $file_name;
	public $addition_class;

	/** @var string reinsurance text*/
	public $text;
	public $title;
	public $prefix;


	/**
	 * @see ObjectModel::$definition
	 */
	public static $definition = array(
		'table' => 'ptscategoriesinfo',
		'primary' => 'id_ptscategoriesinfo',
		'multilang' => true,
		'fields' => array(
			'id_shop' =>				array('type' => self::TYPE_INT, 'validate' => 'isunsignedInt', 'required' => true),
			'id_category' =>				array('type' => self::TYPE_INT, 'validate' => 'isunsignedInt', 'required' => true),
			'file_name' =>				array('type' => self::TYPE_STRING, 'validate' => 'isFileName'),
			'addition_class' =>					array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),
			// Lang fields
			'text' =>					array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isString'),
			'title' =>					array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'required' => true, 'size' => 255),
			'prefix' =>					array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255),
			
		)
	);

	public function copyFromPost()
	{
		/* Classical fields */
		foreach ($_POST AS $key => $value)
			if (array_key_exists($key, $this) AND $key != 'id_'.$this->table)
				$this->{$key} = $value;

		/* Multilingual fields */
		if (sizeof($this->fieldsValidateLang))
		{
			$languages = Language::getLanguages(false);
			foreach ($languages AS $language)
				foreach ($this->fieldsValidateLang AS $field => $validation)
					if (isset($_POST[$field.'_'.(int)($language['id_lang'])]))
						$this->{$field}[(int)($language['id_lang'])] = $_POST[$field.'_'.(int)($language['id_lang'])];
		}
	}
}

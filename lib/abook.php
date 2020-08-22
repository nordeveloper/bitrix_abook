<?php
namespace Kreativ\Abook;

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

/**
 * Class AbookTable
 * 
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> ACTIVE bool optional default 'Y'
 * <li> SORT int optional default 500
 * <li> FIO string(255) mandatory
 * <li> EMAIL string(255) mandatory
 * <li> PHONE string(255) mandatory
 * <li> COMPANY string(255) mandatory
 * <li> POSITION string(255) mandatory
 * <li> SPECIALIZATION string(255) mandatory
 * <li> COUNTRY string(255) mandatory
 * <li> CITY string(255) mandatory
 * <li> ADDRESS string(255) mandatory
 * </ul>
 *
 * @package Bitrix\Nordev
 **/

class AbookTable extends Main\Entity\DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'b_kreativ_abook';
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap()
	{
		return array(
			'ID' => array(
				'data_type' => 'integer',
				'primary' => true,
				'autocomplete' => true,
				'title' => Loc::getMessage('ABOOK_ENTITY_ID_FIELD'),
			),
			'ACTIVE' => array(
				'data_type' => 'boolean',
				'values' => array('N', 'Y'),
				'title' => Loc::getMessage('ABOOK_ENTITY_ACTIVE_FIELD'),
			),
			'SORT' => array(
				'data_type' => 'integer',
				'title' => Loc::getMessage('ABOOK_ENTITY_SORT_FIELD'),
			),
			'FIO' => array(
				'data_type' => 'string',
				'required' => true,
				'validation' => array(__CLASS__, 'validateFio'),
				'title' => Loc::getMessage('ABOOK_ENTITY_FIO_FIELD'),
			),
			'EMAIL' => array(
				'data_type' => 'string',
				'required' => true,
				'validation' => array(__CLASS__, 'validateEmail'),
				'title' => Loc::getMessage('ABOOK_ENTITY_EMAIL_FIELD'),
			),
			'PHONE' => array(
				'data_type' => 'string',
				'required' => true,
				'validation' => array(__CLASS__, 'validatePhone'),
				'title' => Loc::getMessage('ABOOK_ENTITY_PHONE_FIELD'),
			),
			'COMPANY' => array(
				'data_type' => 'string',
				'required' => false,
				'validation' => array(__CLASS__, 'validateCompany'),
				'title' => Loc::getMessage('ABOOK_ENTITY_COMPANY_FIELD'),
			),
			'POSITION' => array(
				'data_type' => 'string',
				'required' => false,
				'validation' => array(__CLASS__, 'validatePosition'),
				'title' => Loc::getMessage('ABOOK_ENTITY_POSITION_FIELD'),
			),
			'SPECIALIZATION' => array(
				'data_type' => 'string',
				'required' => false,
				'validation' => array(__CLASS__, 'validateSpecialization'),
				'title' => Loc::getMessage('ABOOK_ENTITY_SPECIALIZATION_FIELD'),
			),
			'COUNTRY' => array(
				'data_type' => 'string',
				'required' => false,
				'validation' => array(__CLASS__, 'validateCountry'),
				'title' => Loc::getMessage('ABOOK_ENTITY_COUNTRY_FIELD'),
			),
			'CITY' => array(
				'data_type' => 'string',
				'required' => false,
				'validation' => array(__CLASS__, 'validateCity'),
				'title' => Loc::getMessage('ABOOK_ENTITY_CITY_FIELD'),
			),
			'ADDRESS' => array(
				'data_type' => 'string',
				'required' => false,
				'validation' => array(__CLASS__, 'validateAddress'),
				'title' => Loc::getMessage('ABOOK_ENTITY_ADDRESS_FIELD'),
			),			
		);
	}
	/**
	 * Returns validators for FIO field.
	 *
	 * @return array
	 */
	public static function validateFio()
	{
		return array(
			new Main\Entity\Validator\Length(null, 255),
		);
	}
	/**
	 * Returns validators for EMAIL field.
	 *
	 * @return array
	 */
	public static function validateEmail()
	{
		return array(
			new Main\Entity\Validator\Length(null, 255),
		);
	}
	/**
	 * Returns validators for PHONE field.
	 *
	 * @return array
	 */
	public static function validatePhone()
	{
		return array(
			new Main\Entity\Validator\Length(null, 255),
		);
	}
	/**
	 * Returns validators for COMPANY field.
	 *
	 * @return array
	 */
	public static function validateCompany()
	{
		return array(
			new Main\Entity\Validator\Length(null, 255),
		);
	}
	/**
	 * Returns validators for POSITION field.
	 *
	 * @return array
	 */
	public static function validatePosition()
	{
		return array(
			new Main\Entity\Validator\Length(null, 255),
		);
	}
	/**
	 * Returns validators for SPECIALIZATION field.
	 *
	 * @return array
	 */
	public static function validateSpecialization()
	{
		return array(
			new Main\Entity\Validator\Length(null, 255),
		);
	}		
	/**
	 * Returns validators for COUNTRY field.
	 *
	 * @return array
	 */
	public static function validateCountry()
	{
		return array(
			new Main\Entity\Validator\Length(null, 255),
		);
	}
	/**
	 * Returns validators for CITY field.
	 *
	 * @return array
	 */
	public static function validateCity()
	{
		return array(
			new Main\Entity\Validator\Length(null, 255),
		);
	}
	/**
	 * Returns validators for ADDRESS field.
	 *
	 * @return array
	 */
	public static function validateAddress()
	{
		return array(
			new Main\Entity\Validator\Length(null, 255),
		);
	}
	
}
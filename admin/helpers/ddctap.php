<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_ddctap
 */

defined('_JEXEC') or die;

/**
 * Ddcbookit component helper.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_ddctap
 * @since       1.6
 */
class DdctapHelpersDdctap
{
	public static $extension = 'com_ddctap';

	/**
	 * @return  JObject
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_ddctap';
		$level = 'component';

		$actions = JAccess::getActions('com_ddctap', $level);

		foreach ($actions as $action)
		{
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}
	
	public static function addSubmenu($submenu)
	{
		JSubMenuHelper::addEntry(JText::_('COM_DDCTAP_CATEGORIES'),
		'index.php?option=com_categories&view=categories&extension=com_ddctap', $submenu == 'categories');
 		JSubMenuHelper::addEntry(JText::_('COM_DDCTAP_OPTIONS'),
 		'index.php?option=com_ddctap&view=ddctapoptions', $submenu == 'options');
// 		JSubMenuHelper::addEntry(JText::_('COM_DDCBOOKIT_APARTMENTS'),
// 		'index.php?option=com_ddcbookit&view=apartments', $submenu == 'apartments');
// 		JSubMenuHelper::addEntry(JText::_('COM_DDCBOOKIT_APARTMENT_PROPTYPES'),
// 		'index.php?option=com_ddcbookit&view=proptypes', $submenu == 'proptypes');
// 		JSubMenuHelper::addEntry(JText::_('COM_DDCBOOKIT_APARTMENT_PRICES'),
// 		'index.php?option=com_ddcbookit&view=prices', $submenu == 'prices');
// 		JSubMenuHelper::addEntry(JText::_('COM_DDCBOOKIT_APARTMENT_SERVICES'),
// 		'index.php?option=com_ddcbookit&view=services', $submenu == 'services');
// 		JSubMenuHelper::addEntry(JText::_('COM_DDCBOOKIT_APARTMENT_BOOKINGS'),
// 		'index.php?option=com_ddcbookit&view=bookings', $submenu == 'bookings');
		// set some global property
		$document = JFactory::getDocument();

		if ($submenu == 'categories')
		{
			$document->setTitle(JText::_('COM_DDCTAP_ADMINISTRATION_CATEGORIES'));
		}
	}
}
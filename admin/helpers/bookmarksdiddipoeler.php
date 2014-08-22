<?php

defined('_JEXEC') or die();

if (! defined('DS'))
{
	define('DS', DIRECTORY_SEPARATOR);
}

JLoader::import('joomla.application.component.helper');
JLoader::import('joomla.application.categories');
JLoader::import('joomla.environment.browser');
JLoader::import('joomla.filesystem.file');

//JLoader::register('DPCalendarHelperIcal', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_dpcalendar' . DS . 'helpers' . DS . 'ical.php');
//JLoader::register('DPCalendarHelperLocation', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_dpcalendar' . DS . 'helpers' . DS . 'location.php');
//
//JLoader::register('DPCalendarHelperPayment', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_dpcalendar' . DS . 'helpers' . DS . 'payment.php');
//
//if (! class_exists('Mustache'))
//{
//	JLoader::register('Mustache',
//			JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_dpcalendar' . DS . 'libraries' . DS . 'mustache' . DS . 'Mustache.php');
//}

class bookmarksdiddipoelerHelper
{

	private static $lookup;

	private static $calendars = array();

public static function isJoomlaVersion ($version)
	{
		$j = new JVersion();
		return substr($j->RELEASE, 0, strlen($version)) == $version;
	}
    
    public static function addSubmenu ($vName = 'cpanel')
	{
		JSubMenuHelper::addEntry(JText::_('COM_BOOKMARKSDIDDIPOELER_SUBMENU_CPANEL'), 'index.php?option=com_bookmarksdiddipoeler&view=cpanel', $vName == 'cpanel');
		JSubMenuHelper::addEntry(JText::_('COM_BOOKMARKSDIDDIPOELER_SUBMENU_BOOKMARKS'), 'index.php?option=com_bookmarksdiddipoeler&view=bookmarks', $vName == 'bookmarks');
		JSubMenuHelper::addEntry(JText::_('COM_BOOKMARKSDIDDIPOELER_SUBMENU_CATEGORIES'), 'index.php?option=com_categories&extension=com_bookmarksdiddipoeler', $vName == 'categories');
		
//        JSubMenuHelper::addEntry(JText::_('COM_DPCALENDAR_SUBMENU_LOCATIONS'), 'index.php?option=com_dpcalendar&view=locations',
//				$vName == 'locations');

//		if (! self::isFree())
//		{
//			JSubMenuHelper::addEntry(JText::_('COM_DPCALENDAR_SUBMENU_ATTENDEES'), 'index.php?option=com_dpcalendar&view=attendees',
//					$vName == 'attendees');
//		}

//		JSubMenuHelper::addEntry(JText::_('COM_DPCALENDAR_SUBMENU_TOOLS'), 'index.php?option=com_dpcalendar&view=tools', $vName == 'tools');
//		JSubMenuHelper::addEntry(JText::_('COM_DPCALENDAR_SUBMENU_SUPPORT'), 'index.php?option=com_dpcalendar&view=support', $vName == 'support');

		if ($vName == 'categories')
		{
			JToolBarHelper::title(JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_bookmarksdiddipoeler')), 'bookmarksdiddipoeler-categories');
		}
	}
    
    public static function getActions ($categoryId = 0)
	{
		$user = JFactory::getUser();
		$result = new JObject();

		if (empty($categoryId))
		{
			$assetName = 'com_bookmarksdiddipoeler';
			$level = 'component';
		}
		else
		{
			$assetName = 'com_bookmarksdiddipoeler.category.' . (int) $categoryId;
			$level = 'category';
		}

		$actions = JAccess::getActions('com_bookmarksdiddipoeler', $level);

		foreach ($actions as $action)
		{
			$result->set($action->name, $user->authorise($action->name, $assetName));
		}

		return $result;
	}
    
}

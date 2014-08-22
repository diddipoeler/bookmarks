<?php
/**
 * @package    bookmark diddipoeler
 * @author     Dieter Plöger http://www.fussballineuropa.de
 * @copyright  Copyright (C) 2014 Dieter Plöger. All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
 
defined('_JEXEC') or die();

if (! defined('DS'))
{
	define('DS', DIRECTORY_SEPARATOR);
}

JLoader::import('joomla.application.component.helper');
JLoader::import('joomla.application.categories');
JLoader::import('joomla.environment.browser');
JLoader::import('joomla.filesystem.file');

/**
 * bookmarksdiddipoelerHelper
 * 
 * @package 
 * @author diddi
 * @copyright 2014
 * @version $Id$
 * @access public
 */
class bookmarksdiddipoelerHelper
{

	private static $lookup;

	private static $calendars = array();

/**
 * bookmarksdiddipoelerHelper::isJoomlaVersion()
 * 
 * @param mixed $version
 * @return
 */
public static function isJoomlaVersion ($version)
	{
		$j = new JVersion();
		return substr($j->RELEASE, 0, strlen($version)) == $version;
	}
    
    /**
     * bookmarksdiddipoelerHelper::addSubmenu()
     * 
     * @param string $vName
     * @return void
     */
    public static function addSubmenu ($vName = 'cpanel')
	{
		JSubMenuHelper::addEntry(JText::_('COM_BOOKMARKSDIDDIPOELER_SUBMENU_CPANEL'), 'index.php?option=com_bookmarksdiddipoeler&view=cpanel', $vName == 'cpanel');
		JSubMenuHelper::addEntry(JText::_('COM_BOOKMARKSDIDDIPOELER_SUBMENU_BOOKMARKS'), 'index.php?option=com_bookmarksdiddipoeler&view=bookmarks', $vName == 'bookmarks');
		JSubMenuHelper::addEntry(JText::_('COM_BOOKMARKSDIDDIPOELER_SUBMENU_CATEGORIES'), 'index.php?option=com_categories&extension=com_bookmarksdiddipoeler', $vName == 'categories');

		if ($vName == 'categories')
		{
			JToolBarHelper::title(JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_bookmarksdiddipoeler')), 'bookmarksdiddipoeler-categories');
		}
	}
    
    /**
     * bookmarksdiddipoelerHelper::getActions()
     * 
     * @param integer $categoryId
     * @return
     */
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

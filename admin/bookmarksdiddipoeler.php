<?php             

defined('_JEXEC') or die();

JLoader::import('components.com_bookmarksdiddipoeler.helpers.bookmarksdiddipoeler', JPATH_ADMINISTRATOR);

if (! JFactory::getUser()->authorise('core.manage', 'com_bookmarksdiddipoeler'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

JLoader::import('joomla.application.component.controller');

$path = JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_bookmarksdiddipoeler' . DS . 'bookmarks.xml';
if (file_exists($path))
{
	$manifest = simplexml_load_file($path);
	JRequest::setVar('BOOKMARKSDIDDIPOELER_VERSION', $manifest->version);
}
else
{
	JRequest::setVar('BOOKMARKSDIDDIPOELER_VERSION', '');
}

if (version_compare(PHP_VERSION, '5.3.0') < 0)
{
	JError::raiseWarning(0,
			'You have PHP version ' . PHP_VERSION . ' installed. This version is end of life and contains some security wholes!!
					 		Please upgrade your PHP version to at least 5.3.x. DPCalendar can not run on this version.');
	return;
}

$controller = JControllerLegacy::getInstance('bookmarksdiddipoeler');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
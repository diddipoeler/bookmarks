<?php

defined('_JEXEC') or die();

class bookmarks_diddipoelerController extends JControllerLegacy
{

	public function display ($cachable = false, $urlparams = false)
	{
		$view = JRequest::setVar('view', JRequest::getCmd('view', 'cpanel'));
		$layout = JRequest::getCmd('layout', 'default');
		$id = JRequest::getInt('id');

		if ($view != 'event' && $view != 'location' && $view != 'attendee')
		{
			bookmarksHelper::addSubmenu(JRequest::getCmd('view', 'cpanel'));
		}
/*
		// Check for edit form.
		if ($view == 'event' && $layout == 'edit' && ! $this->checkEditId('com_dpcalendar.edit.event', $id))
		{
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_dpcalendar&view=dpcalendar', false));

			return false;
		}
*/
		parent::display();

		return $this;
	}
}

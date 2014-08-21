<?php

defined('_JEXEC') or die();

class bookmarks_diddipoelerView extends JViewLegacy
{

	protected $icon = '';

	protected $title = '';

	public function display ($tpl = null)
	{
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		if (bookmarksHelper::isJoomlaVersion('2.5'))
		{
			$this->setLayout($this->getLayout() . '_25');
		}
		if (bookmarksHelper::isJoomlaVersion('3'))
		{
			$this->setLayout($this->getLayout() . '_3');
		}

		$this->init();

		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar ()
	{
		$canDo = bookmarksHelper::getActions();

		if (empty($this->title))
		{
			$this->title = 'COM_BOOKMARKS_DIDDIPOELER_MANAGER_' . strtoupper($this->getName());
		}
		if (empty($this->icon))
		{
			$this->icon = strtolower($this->getName());
		}
		JToolBarHelper::title(JText::_($this->title), $this->icon);
		$document = JFactory::getDocument();
		$document->addStyleDeclaration(
				'.icon-48-' . $this->icon . ' {background-image: url(../media/com_bookmarks_diddipoeler/images/admin/48-' . $this->icon .
						 '.png);background-repeat: no-repeat;}');

		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::preferences('com_bookmarks_diddipoeler');
			JToolBarHelper::divider();
		}
	}

	protected function init ()
	{
	}
}

<?php

defined('_JEXEC') or die();

class bookmarksdiddipoelerView extends JViewLegacy
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

		if (bookmarksdiddipoelerHelper::isJoomlaVersion('2.5'))
		{
			$this->setLayout($this->getLayout() . '_25');
		}
		if (bookmarksdiddipoelerHelper::isJoomlaVersion('3'))
		{
			$this->setLayout($this->getLayout() . '_3');
		}

		$this->init();

		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar ()
	{
		$canDo = bookmarksdiddipoelerHelper::getActions();

		if (empty($this->title))
		{
			$this->title = 'COM_BOOKMARKSDIDDIPOELER_MANAGER_' . strtoupper($this->getName());
		}
		if (empty($this->icon))
		{
			$this->icon = strtolower($this->getName());
		}
		JToolBarHelper::title(JText::_($this->title), $this->icon);
		$document = JFactory::getDocument();
		$document->addStyleDeclaration(
				'.icon-48-' . $this->icon . ' {background-image: url(../media/com_bookmarksdiddipoeler/images/admin/48-' . $this->icon .
						 '.png);background-repeat: no-repeat;}');

		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::preferences('com_bookmarksdiddipoeler');
			JToolBarHelper::divider();
		}
	}

	protected function init ()
	{
	}
}

<?php

defined('_JEXEC') or die();


JLoader::import('components.com_bookmarksdiddipoeler.libraries.bookmarks.view', JPATH_ADMINISTRATOR);

class bookmarksdiddipoelerViewbookmark extends bookmarksdiddipoelerView
{

	protected $state;

	protected $item;

	protected $form;

	protected $canDo;

	protected $freeInformationText;

	protected function init ()
	{
		
        $language = JFactory::getLanguage();
        $extension = 'com_weblinks';
        $base_dir = JPATH_ADMIN;
        $language_tag = $language->getTag(); // loads the current language-tag
        $language->load($extension, $base_dir, $language_tag, true);
        
        $this->state = $this->get('State');
		$this->item = $this->get('Item');
		$this->form = $this->get('Form');
		$this->form->setFieldAttribute('user_id', 'type', 'hidden');
//		$this->form->setFieldAttribute('start_date', 'format', DPCalendarHelper::getComponentParameter('event_form_date_format', 'm.d.Y'));
//		$this->form->setFieldAttribute('start_date', 'formatTime', DPCalendarHelper::getComponentParameter('event_form_time_format', 'g:i a'));
//		$this->form->setFieldAttribute('end_date', 'format', DPCalendarHelper::getComponentParameter('event_form_date_format', 'm.d.Y'));
//		$this->form->setFieldAttribute('end_date', 'formatTime', DPCalendarHelper::getComponentParameter('event_form_time_format', 'g:i a'));

//		$this->canDo = DPCalendarHelper::getActions($this->state->get('filter.category_id'));

//		$this->freeInformationText = '';
//		if (DPCalendarHelper::isFree())
//		{
//			$this->freeInformationText = '<br/><small class="text-warning" style="float:left">' . JText::_('COM_DPCALENDAR_ONLY_AVAILABLE_SUBSCRIBERS') . '</small>';
//		}
	}

	protected function addToolbar ()
	{
		JRequest::setVar('hidemainmenu', true);

		$user = JFactory::getUser();
		$userId = $user->get('id');
		$isNew = ($this->item->id == 0);
		$checkedOut = ! ($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		$canDo = DPCalendarHelper::getActions($this->item->catid, 0);

		if (! $checkedOut && ($canDo->get('core.edit') || (count($user->getAuthorisedCategories('com_bookmarksdiddipoeler', 'core.create')))))
		{
			JToolBarHelper::apply('bookmark.apply');
			JToolBarHelper::save('bookmark.save');
		}
		if (! $checkedOut && (count($user->getAuthorisedCategories('com_bookmarksdiddipoeler', 'core.create'))))
		{
			JToolBarHelper::save2new('bookmark.save2new');
		}
		if (! $isNew && (count($user->getAuthorisedCategories('com_bookmarksdiddipoeler', 'core.create')) > 0))
		{
			JToolBarHelper::save2copy('bookmark.save2copy');
		}
		if (empty($this->item->id))
		{
			JToolBarHelper::cancel('bookmark.cancel');
		}
		else
		{
			JToolBarHelper::cancel('bookmark.cancel', 'JTOOLBAR_CLOSE');
		}
		parent::addToolbar();
	}
}

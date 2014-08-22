<?php
/**
 * @package    bookmark diddipoeler
 * @author     Dieter Plöger http://www.fussballineuropa.de
 * @copyright  Copyright (C) 2014 Dieter Plöger. All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
 
defined('_JEXEC') or die();


JLoader::import('components.com_bookmarksdiddipoeler.libraries.bookmarks.view', JPATH_ADMINISTRATOR);

/**
 * bookmarksdiddipoelerViewbookmark
 * 
 * @package 
 * @author diddi
 * @copyright 2014
 * @version $Id$
 * @access public
 */
class bookmarksdiddipoelerViewbookmark extends bookmarksdiddipoelerView
{

	protected $state;

	protected $item;

	protected $form;

	protected $canDo;

	protected $freeInformationText;

	/**
	 * bookmarksdiddipoelerViewbookmark::init()
	 * 
	 * @return void
	 */
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

	}

	/**
	 * bookmarksdiddipoelerViewbookmark::addToolbar()
	 * 
	 * @return void
	 */
	protected function addToolbar ()
	{
		JRequest::setVar('hidemainmenu', true);

		$user = JFactory::getUser();
		$userId = $user->get('id');
		$isNew = ($this->item->id == 0);
		$checkedOut = ! ($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		$canDo = bookmarksdiddipoelerHelper::getActions($this->item->catid, 0);

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

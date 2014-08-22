<?php
/**
 * @package    bookmark diddipoeler
 * @author     Dieter Plöger http://www.fussballineuropa.de
 * @copyright  Copyright (C) 2014 Dieter Plöger. All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
defined('_JEXEC') or die();


JLoader::import('components.com_bookmarksdiddipoeler.libraries.bookmarks.view', JPATH_ADMINISTRATOR);

class bookmarksdiddipoelerViewbookmarks extends bookmarksdiddipoelerView
{

	protected $items;

	protected $pagination;

	protected $state;

	//protected $authors;

	public function init ()
	{
		$this->setModel(JModelLegacy::getInstance('bookmarks', 'bookmarksdiddipoelerModel'), true);
		$this->state = $this->get('State');
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		//$this->authors = $this->get('Authors');
	}

	protected function addToolbar ()
	{
		if (strpos($this->getLayout(), 'modal') !== false)
		{
			return;
		}

		$state = $this->get('State');
		$canDo = bookmarksdiddipoelerHelper::getActions($state->get('filter.category_id'));
		$user = JFactory::getUser();

		$bar = JToolBar::getInstance('toolbar');
        
        // page rank
        JToolBarHelper::addNew('bookmarks.get_google_pagerank');

		if (count($user->getAuthorisedCategories('com_bookmarksdiddipoeler', 'core.create')) > 0)
		{
			JToolBarHelper::addNew('bookmark.add');
		}
		if ($canDo->get('core.edit'))
		{
			JToolBarHelper::editList('bookmark.edit');
		}
		if ($canDo->get('core.edit.state'))
		{
			JToolBarHelper::divider();
			JToolBarHelper::publish('bookmarks.publish', 'JTOOLBAR_PUBLISH', true);
			JToolBarHelper::unpublish('bookmarks.unpublish', 'JTOOLBAR_UNPUBLISH', true);

			JToolBarHelper::divider();
			JToolBarHelper::archiveList('bookmarks.archive');
			JToolBarHelper::checkin('bookmarks.checkin');
		}
		if ($state->get('filter.published') == - 2 && $canDo->get('core.delete'))
		{
			JToolBarHelper::deleteList('', 'bookmarks.delete', 'JTOOLBAR_EMPTY_TRASH');
			JToolBarHelper::divider();
		}
		else if ($canDo->get('core.edit.state'))
		{
			JToolBarHelper::trash('bookmarks.trash');
			JToolBarHelper::divider();
		}

		if ($user->authorise('core.edit') && bookmarksdiddipoelerHelper::isJoomlaVersion('3'))
		{
			$title = JText::_('JTOOLBAR_BATCH');
			$dhtml = "<button data-toggle=\"modal\" data-target=\"#collapseModal\" class=\"btn btn-small\">
			<i class=\"icon-checkbox-partial\" title=\"$title\"></i>
			$title</button>";
			$bar->appendButton('Custom', $dhtml, 'batch');
		}
		parent::addToolbar();
	}
}

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
 * bookmarksdiddipoelerViewCpanel
 * 
 * @package 
 * @author diddi
 * @copyright 2014
 * @version $Id$
 * @access public
 */
class bookmarksdiddipoelerViewCpanel extends bookmarksdiddipoelerView
{

	protected $icon = 'bookmarks';

	protected $title = 'COM_BOOKMARKSDIDDIPOELER_VIEW_CPANEL';

	/**
	 * bookmarksdiddipoelerViewCpanel::init()
	 * 
	 * @return void
	 */
	protected function init ()
	{

		parent::init();
	}
}

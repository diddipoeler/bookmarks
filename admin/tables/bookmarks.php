<?php
/**
 * @package    bookmark diddipoeler
 * @author     Dieter Plöger http://www.fussballineuropa.de
 * @copyright  Copyright (C) 2014 Dieter Plöger. All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

// import Joomla table library
jimport('joomla.database.table');

// Include library dependencies
jimport( 'joomla.filter.input' );


/**
 * bookmarksdiddipoelerTablebookmarks
 * 
 * @package 
 * @author diddi
 * @copyright 2014
 * @version $Id$
 * @access public
 */
class bookmarksdiddipoelerTablebookmarks extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	function __construct(& $db)
	{
		parent::__construct( '#__bookmarks', 'id', $db );
	}

	

}
?>

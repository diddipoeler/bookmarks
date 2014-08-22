<?php
/**
 * @package    bookmark diddipoeler
 * @author     Dieter Plöger http://www.fussballineuropa.de
 * @copyright  Copyright (C) 2014 Dieter Plöger. All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
 
defined('_JEXEC') or die();

JLoader::import('joomla.application.component.controlleradmin');

/**
 * bookmarksdiddipoelerControllerbookmarks
 * 
 * @package 
 * @author diddi
 * @copyright 2014
 * @version $Id$
 * @access public
 */
class bookmarksdiddipoelerControllerbookmarks extends JControllerAdmin
{

	/**
	 * bookmarksdiddipoelerControllerbookmarks::__construct()
	 * 
	 * @param mixed $config
	 * @return void
	 */
	public function __construct ($config = array())
	{
		parent::__construct($config);
//		$this->registerTask('unfeatured', 'featured');
	}

	/**
	 * bookmarksdiddipoelerControllerbookmarks::getModel()
	 * 
	 * @param string $name
	 * @param string $prefix
	 * @param mixed $config
	 * @return
	 */
	public function getModel ($name = 'bookmark', $prefix = 'bookmarksdiddipoelerModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
    
    
    /**
     * bookmarksdiddipoelerControllerbookmarks::get_google_pagerank()
     * 
     * @return void
     */
    function get_google_pagerank()
	{
	   $model = $this->getModel();
       $model->get_google_pagerank();
       $this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_list, false));
    } 
    
    
}    
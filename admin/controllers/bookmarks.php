<?php

defined('_JEXEC') or die();

JLoader::import('joomla.application.component.controlleradmin');

class bookmarksdiddipoelerControllerbookmarks extends JControllerAdmin
{

	public function __construct ($config = array())
	{
		parent::__construct($config);
//		$this->registerTask('unfeatured', 'featured');
	}

	public function getModel ($name = 'bookmark', $prefix = 'bookmarksdiddipoelerModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
    
    
    function get_google_pagerank()
	{
	   $model = $this->getModel();
       $model->get_google_pagerank();
       $this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_list, false));
    } 
    
    
}    
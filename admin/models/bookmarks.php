<?php
/**
 * @package    bookmark diddipoeler
 * @author     Dieter Plöger http://www.fussballineuropa.de
 * @copyright  Copyright (C) 2014 Dieter Plöger. All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
 
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

// import the Joomla modellist library
jimport('joomla.application.component.modellist');

/**
 * bookmarksdiddipoelerModelbookmarks
 * 
 * @package 
 * @author diddi
 * @copyright 2014
 * @version $Id$
 * @access public
 */
class bookmarksdiddipoelerModelbookmarks extends JModelList
{
	var $_identifier = "bookmarks";
    
    
    /**
     * bookmarksdiddipoelerModelbookmarks::__construct()
     * 
     * @param mixed $config
     * @return void
     */
    public function __construct($config = array())
        {   
                $config['filter_fields'] = array(
                'b.title',
  'b.url',
  'b.description',
  'b.detail',
  'b.imageurl',
  'b.created',
  'b.modified',
  'b.rating',
  'b.ratingcount',
  'b.ratingadmin',
  'b.hits',
  'b.published',
  'b.access',
  'b.checked_out',
  'b.created_by',
  'b.checked_out_time',
  'b.archived',
  'b.approved',
  'b.validated',
  'b.validationdate',
  'b.validationstatus',
  'b.pagerank',
  'b.redirect',
  'b.private',
  'b.openwin',
  'b.keywords',
  'b.credits'
                        );
                parent::__construct($config);
        }
    
    
    
    /**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$mainframe = JFactory::getApplication();
        $option = JRequest::getCmd('option');
        // Initialise variables.
		$app = JFactory::getApplication('administrator');
        
        //$mainframe->enqueueMessage(JText::_('sportsmanagementModelsmquotes populateState context<br><pre>'.print_r($this->context,true).'</pre>'   ),'');

		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
//		$search = $this->getUserStateFromRequest($this->context . '.filter.search_start', 'filter_search_start', DPCalendarHelper::getDate()->format('Y-m-d'));
//		$this->setState('filter.search_start', $search);
//		$search = $this->getUserStateFromRequest($this->context . '.filter.search_end', 'filter_search_end');
//		$this->setState('filter.search_end', $search);

		$accessId = $this->getUserStateFromRequest($this->context . '.filter.access', 'filter_access', 0, 'int');
		$this->setState('filter.access', $accessId);
//		$accessId = $this->getUserStateFromRequest($this->context . '.filter.author_id', 'filter_author_id');
//		$this->setState('filter.author_id', $accessId);

//		$published = $this->getUserStateFromRequest($this->context . '.filter.event_type', 'filter_event_type', '', 'string');
//		$this->setState('filter.event_type', $published);

		$published = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		$categoryId = $this->getUserStateFromRequest($this->context . '.filter.category_id', 'filter_category_id');
		$this->setState('filter.category_id', $categoryId);

//		$level = $this->getUserStateFromRequest($this->context . '.filter.level', 'filter_level', 0, 'int');
//		$this->setState('filter.level', $level);

		$language = $this->getUserStateFromRequest($this->context . '.filter.language', 'filter_language', '');
		$this->setState('filter.language', $language);
        
        $value = JRequest::getUInt('limitstart', 0);
		$this->setState('list.start', $value);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_bookmarksdiddipoeler');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('b.title', 'asc');
	}
    
    
    /**
     * bookmarksdiddipoelerModelbookmarks::getListQuery()
     * 
     * @return
     */
    protected function getListQuery()
	{
		$mainframe = JFactory::getApplication();
        $option = JRequest::getCmd('option');
//        $search	= $this->getState('filter.search');
//        $search_nation	= $this->getState('filter.search_nation');
//        $search_season = $this->getState('filter.season');

        // Create a new query object.		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		// Select some fields
		//$query->select(implode(",",$this->filter_fields));
        $query->select($this->getState('list.select', 'b.*'));
		// From the table
		$query->from('#__bookmarks as b');
        
        // Join over the language
		$query->select('l.title AS language_title');
		$query->join('LEFT', $db->quoteName('#__languages') . ' AS l ON l.lang_code = b.language');
        
        // Join over the users for the checked out user.
		$query->select('uc.name AS editor');
		$query->join('LEFT', '#__users AS uc ON uc.id = b.checked_out');
        
        // Join over the asset groups.
		$query->select('ag.title AS access_level');
		$query->join('LEFT', '#__viewlevels AS ag ON ag.id = b.access');

		// Join over the categories.
		$query->select('c.title AS category_title');
		$query->join('LEFT', '#__categories AS c ON c.id = b.catid');

		// Join over the users for the author.
		$query->select('ua.name AS author_name');
		$query->join('LEFT', '#__users AS ua ON ua.id = b.created_by');
        
        // Filter by access level.
		if ($access = $this->getState('filter.access'))
		{
			$query->where('b.access = ' . (int) $access);
		}
        // Filter by published state
		$published = $this->getState('filter.published');
		if (is_numeric($published))
		{
			$query->where('b.published = ' . (int) $published);
		}
        // Filter by a single or group of categories.
		$baselevel = 1;
		$categoryId = $this->getState('filter.category_id');
		if (is_numeric($categoryId))
		{
			$cat_tbl = JTable::getInstance('Category', 'JTable');
			$cat_tbl->load($categoryId);
			$rgt = $cat_tbl->rgt;
			$lft = $cat_tbl->lft;
			$baselevel = (int) $cat_tbl->level;
			$query->where('c.lft >= ' . (int) $lft);
			$query->where('c.rgt <= ' . (int) $rgt);
		}
		elseif (is_array($categoryId))
		{
			JArrayHelper::toInteger($categoryId);
			$categoryId = implode(',', $categoryId);
			$query->where('b.catid IN (' . $categoryId . ')');
		}
        // Filter on the language.
		if ($language = $this->getState('filter.language'))
		{
			$query->where('b.language = ' . $db->quote($language));
		}
        // Filter by search in title
		$search = $this->getState('filter.search');
		if (! empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('b.id = ' . (int) substr($search, 3));
			}
			elseif (stripos($search, 'author:') === 0)
			{
				$search = $db->Quote('%' . $db->escape(substr($search, 7), true) . '%');
				$query->where('(ua.name LIKE ' . $search . ' OR ua.username LIKE ' . $search . ')');
			}
			else
			{
				$search = $db->Quote('%' . $db->escape($search, true) . '%');
				$query->where('(b.title LIKE ' . $search . ' OR b.detail LIKE ' . $search . ' OR b.description LIKE ' . $search . ')');
			}
		}
        
        
        $query->order($db->escape($this->getState('list.ordering', 'b.title')).' '.
                $db->escape($this->getState('list.direction', 'ASC')));
        

//        $mainframe->enqueueMessage(JText::_(__METHOD__.' '.__LINE__.' <br><pre>'.print_r($query->dump(),true).'</pre>'),'Notice');

        

		return $query;
        
    }  
    
    
    
 


    
    
      
    
}    
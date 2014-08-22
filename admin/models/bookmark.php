<?php
/**
 * @package    bookmark diddipoeler
 * @author     Dieter Plöger http://www.fussballineuropa.de
 * @copyright  Copyright (C) 2014 Dieter Plöger. All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
 
defined('_JEXEC') or die();

JLoader::import('joomla.application.component.modeladmin');

/**
 * BookmarksdiddipoelerModelBookmark
 * 
 * @package 
 * @author diddi
 * @copyright 2014
 * @version $Id$
 * @access public
 */
class BookmarksdiddipoelerModelBookmark extends JModelAdmin
{

	protected $text_prefix = 'COM_BOOKMARKSDIDDIPOELER';

//	private $eventHandler = null;

	/**
	 * BookmarksdiddipoelerModelBookmark::__construct()
	 * 
	 * @param mixed $config
	 * @return void
	 */
	public function __construct ($config = array())
	{
		parent::__construct($config);
//		$dispatcher = JDispatcher::getInstance();
//		$this->eventHandler = new EventHandler($dispatcher, $this);
	}
    
    /**
     * BookmarksdiddipoelerModelBookmark::getTable()
     * 
     * @param string $type
     * @param string $prefix
     * @param mixed $config
     * @return
     */
    public function getTable ($type = 'bookmarks', $prefix = 'bookmarksdiddipoelerTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
    
    
    /**
	 * Method to get the record form.
	 *
	 * @param	array	$data		Data for the form.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	mixed	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true) 
	{
		$mainframe = JFactory::getApplication();
        $option = JRequest::getCmd('option');
//        $cfg_which_media_tool = JComponentHelper::getParams($option)->get('cfg_which_media_tool',0);
        //$mainframe->enqueueMessage(JText::_('sportsmanagementModelagegroup getForm cfg_which_media_tool<br><pre>'.print_r($cfg_which_media_tool,true).'</pre>'),'Notice');
        // Get the form.
		$form = $this->loadForm('com_bookmarksdiddipoeler.bookmark', 'bookmark', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) 
		{
			return false;
		}
        

        
		return $form;
	}
    
    /**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData() 
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_bookmarksdiddipoeler.edit.bookmark.data', array());
		if (empty($data)) 
		{
			$data = $this->getItem();
		}
		return $data;
	}
    
    
    /**
     * BookmarksdiddipoelerModelBookmark::get_google_pagerank()
     * 
     * @param mixed $url
     * @return void
     */
    public function get_google_pagerank($url=NULL) 
 {
    $mainframe = JFactory::getApplication();
        $option = JRequest::getCmd('option');
 
 // Get the input
        $pks = JRequest::getVar('cid', null, 'post', 'array');
        $post = JRequest::get('post');
        $row = $this->getTable();
        
//        $mainframe->enqueueMessage(__METHOD__.' '.__LINE__.'saveshort pks<br><pre>'.print_r($pks, true).'</pre><br>','Notice');
//        $mainframe->enqueueMessage(__METHOD__.' '.__LINE__.'saveshort post<br><pre>'.print_r($post, true).'</pre><br>','Notice');
        
 for ($x=0; $x < count($pks); $x++)
		{ 
		  
          $row->load((int) $pks[$x]);
          $url = $row->url;
 if ( $url )       
 {
 $meta = array();   
 $urlArray = parse_url($url);
 
 if (!in_array($urlArray['scheme'],array('','http'))) 
 {
 // nichts machen
      }
 else
 {

// ----------------------------------------
$chx = curl_init();
curl_setopt ($chx, CURLOPT_URL, $url );
//curl_setopt($ch, CURLOPT_VERBOSE, 1);
//curl_setopt ($chx, CURLOPT_HEADER, 0);
curl_setopt ($chx, CURLOPT_TIMEOUT, 200);
//curl_setopt ($chx, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.2) Gecko/20070219 Firefox/2.0.0.2");
curl_setopt ($chx, CURLOPT_RETURNTRANSFER,1);
$buffer = parse_url($url);
$resulttab = curl_exec ($chx);
curl_close ($chx);

// Looking for : <meta name="description" content="text" />
         // or this way : <meta content="text" name="description" />

         preg_match_all("/<meta \s*(.*?)\s*(\/>|>)/i", $resulttab, $m, PREG_SET_ORDER);  // Grab All meta tags

//$mainframe->enqueueMessage(JText::_(__METHOD__.' '.__LINE__.' resulttab -> <br><pre>'.print_r($resulttab,true).'</pre>'),'Notice');
//$mainframe->enqueueMessage(JText::_(__METHOD__.' '.__LINE__.' meta -> <br><pre>'.print_r($m,true).'</pre>'),'Notice');


foreach ($m as $r => $s) 
         {                                                // Extract tag name & content
            preg_match('~name="(\s*(.*?)\s*)"~i', $s[1], $n);
            if (isset($n[1])) 
            {
              $name = strtolower ($n[1]);
              preg_match('~content="(\s*(.*?)\s*)"~i', $s[1], $c);
              $meta[$name] = $c[1];
            }
         }

if ( $meta )
{
$row->keywords = $meta['keywords'];
$row->description = $meta['description'];    
}
           
         
                     
 }
 
// $mainframe->enqueueMessage(JText::_(__METHOD__.' '.__LINE__.' meta -> <br><pre>'.print_r($meta,true).'</pre>'),'Notice');     
// $mainframe->enqueueMessage(JText::_(__METHOD__.' '.__LINE__.' urlArray -> <br><pre>'.print_r($urlArray,true).'</pre>'),'Notice');
 
    
 $query = "http://toolbarqueries.google.com/tbr?client=navclient-auto&ch=".$this->CheckHash($this->HashURL($url)). "&features=Rank&q=info:".$url."&num=100&filter=0";
 $data = file_get_contents($query);
 $pos = strpos($data, "Rank_");
 if($pos === false)
 {
    
 } 
 else
 {
 $pagerank = substr($data, $pos + 9);
 
 $row->pagerank = $pagerank;
				
 }
 
if (!$row->store())
{

}
                
 //$mainframe->enqueueMessage(JText::_(__METHOD__.' '.__LINE__.' <br>'.$pagerank.''),'Notice');
 
 //return $pagerank;
 }
 
 }
 
 }

 /**
  * BookmarksdiddipoelerModelBookmark::StrToNum()
  * 
  * @param mixed $Str
  * @param mixed $Check
  * @param mixed $Magic
  * @return
  */
 public function StrToNum($Str, $Check, $Magic)
 {
 $Int32Unit = 4294967296; // 2^32

 $length = strlen($Str);
 for ($i = 0; $i < $length; $i++) {
 $Check *= $Magic;

 if ($Check >= $Int32Unit) {
 $Check = ($Check - $Int32Unit * (int) ($Check / $Int32Unit));
 $Check = ($Check < -2147483648) ? ($Check + $Int32Unit) : $Check;
 }
 $Check += ord($Str{$i});
 }
 return $Check;
 }

 /**
  * BookmarksdiddipoelerModelBookmark::HashURL()
  * 
  * @param mixed $String
  * @return
  */
 public function HashURL($String)
 {
 $Check1 = $this->StrToNum($String, 0x1505, 0x21);
 $Check2 = $this->StrToNum($String, 0, 0x1003F);

 $Check1 >>= 2;
 $Check1 = (($Check1 >> 4) & 0x3FFFFC0 ) | ($Check1 & 0x3F);
 $Check1 = (($Check1 >> 4) & 0x3FFC00 ) | ($Check1 & 0x3FF);
 $Check1 = (($Check1 >> 4) & 0x3C000 ) | ($Check1 & 0x3FFF);

 $T1 = (((($Check1 & 0x3C0) << 4) | ($Check1 & 0x3C)) <<2 ) | ($Check2 & 0xF0F );
 $T2 = (((($Check1 & 0xFFFFC000) << 4) | ($Check1 & 0x3C00)) << 0xA) | ($Check2 & 0xF0F0000 );

 return ($T1 | $T2);
 }

 /**
  * BookmarksdiddipoelerModelBookmark::CheckHash()
  * 
  * @param mixed $Hashnum
  * @return
  */
 public function CheckHash($Hashnum)
 {
 $CheckByte = 0;
 $Flag = 0;

 $HashStr = sprintf('%u', $Hashnum) ;
 $length = strlen($HashStr);

 for ($i = $length - 1; $i >= 0; $i --) {
 $Re = $HashStr{$i};
 if (1 === ($Flag % 2)) {
 $Re += $Re;
 $Re = (int)($Re / 10) + ($Re % 10);
 }
 $CheckByte += $Re;
 $Flag ++;
 }

 $CheckByte %= 10;
 if (0 !== $CheckByte) {
 $CheckByte = 10 - $CheckByte;
 if (1 === ($Flag % 2) ) {
 if (1 === ($CheckByte % 2)) {
 $CheckByte += 9;
 }
 $CheckByte >>= 1;
 }
 }

 return '7'.$CheckByte.$HashStr;
 }

    
    
}    